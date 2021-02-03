<?php

namespace App\Http\Controllers\Admin\Wilayah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\KecamatanRequest;
use App\Http\Select2\Select2;
use App\Models\Wilayah\Kecamatan;
use Yajra\DataTables\Facades\DataTables;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($nama_kecamatan = $request->get('kecamatan')) {
                $kecamatan = Kecamatan::where('nama', 'like', "%$nama_kecamatan%")->limit(5)->get();

                if ($kabkota_id = $request->get('kabkota_id')) {
                    $kecamatan = Kecamatan::where([
                        ['nama', 'like', "%$nama_kecamatan%"],
                        ['kabkota_id', '=', $kabkota_id],
                    ])->limit(5)->get();
                }

                $select = new Select2();
                foreach ($kecamatan as $kec) {
                    $select->option($kec->id, $kec->nama);
                }

                return $select->render();
            }

            $kecamatan = Kecamatan::query()->with(['kabkota']);
            return DataTables::eloquent($kecamatan)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $edit = view('components.edit', ['url' => route('admin.kecamatan.edit', $row->id)]);
                    $delete = view('components.delete', ['url' => route('admin.kecamatan.destroy', $row->id)]);
                    return $edit.$delete;
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.kecamatan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kecamatan.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\KecamatanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KecamatanRequest $request)
    {
        $fields = $request->getFields();

        if (Kecamatan::create($fields)) {
            return redirect()->route('admin.kecamatan.index')->with('alert', [
                'color' => 'success',
                'content' => trans('kecamatan.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('alert', [
            'color' => 'danger',
            'content' => trans('kecamatan.messages.errors.create'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wilayah\Kecamatan $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kecamatan $kecamatan)
    {
        return view('admin.kecamatan.form', compact(['kecamatan']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\KecamatanRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KecamatanRequest $request, $id)
    {
        if (!$kecamatan = Kecamatan::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('kecamatan.messages.errors.not_found'),
            ]);
        }

        $fields = $request->getFields();
        if ($kecamatan->update($fields)) {
            return redirect()->route('admin.kecamatan.index')->with('alert', [
                'color' => 'success',
                'content' => trans('kecamatan.messages.success.update'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('kecamatan.messages.errors.update'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$kecamatan = Kecamatan::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('kecamatan.messages.errors.not_found'),
            ]);
        }

        if($kecamatan->delete()) {
            return redirect()->back()->with('alert', [
                'color' => 'success',
                'content' => trans('kecamatan.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('kecamatan.messages.errors.delete'),
        ]);
    }
}
