<?php

namespace App\Http\Controllers\Admin\Wilayah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\KabKotaRequest;
use App\Http\Select2\Select2;
use App\Models\Wilayah\KabKota;
use Yajra\DataTables\Facades\DataTables;

class KabKotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($nama_kabkota = $request->get('kabkota')) {
            $kabkota = KabKota::where('nama', 'like', "%$nama_kabkota%")->limit(5)->get();

            if ($provinsi_id = $request->get('provinsi_id')) {
                $kabkota = KabKota::where([
                    ['nama', 'like', "%$nama_kabkota%"],
                    ['provinsi_id', '=', $provinsi_id],
                ])->limit(5)->get();
            }

            $select = new Select2();
            foreach ($kabkota as $kabkot) {
                $select->option($kabkot->id, $kabkot->nama);
            }

            return $select->render();
        }

        if ($request->ajax()) {
            $kabkota = KabKota::query()->with(['provinsi']);
            return DataTables::eloquent($kabkota)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $edit = view('components.edit', ['url' => route('admin.kabkota.edit', $row->id)]);
                    $delete = view('components.delete', ['url' => route('admin.kabkota.destroy', $row->id)]);
                    return $edit.$delete;
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.kabkota.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kabkota.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\KabKotaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KabKotaRequest $request)
    {
        $fields = $request->getFields();

        if (KabKota::create($fields)) {
            return redirect()->route('admin.kabkota.index')->with('alert', [
                'color' => 'success',
                'content' => trans('kabkota.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('alert', [
            'color' => 'danger',
            'content' => trans('kabkota.messages.errors.create'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kabkota = KabKota::find($id);
        return view('admin.kabkota.form', compact(['kabkota']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\KabKotaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KabKotaRequest $request, $id)
    {
        if (!$kabkota = KabKota::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('kabkota.messages.errors.not_found'),
            ]);
        }

        $fields = $request->getFields();
        if ($kabkota->update($fields)) {
            return redirect()->route('admin.kabkota.index')->with('alert', [
                'color' => 'success',
                'content' => trans('kabkota.messages.success.update'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('kabkota.messages.errors.update'),
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
        if (!$kabkota = KabKota::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('kabkota.messages.errors.not_found'),
            ]);
        }

        if($kabkota->delete()) {
            return redirect()->back()->with('alert', [
                'color' => 'success',
                'content' => trans('kabkota.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('kabkota.messages.errors.delete'),
        ]);
    }
}
