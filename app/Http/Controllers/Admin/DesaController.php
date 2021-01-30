<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DesaRequest;
use App\Models\Wilayah\Desa;
use App\Models\Wilayah\Kecamatan;
use Yajra\DataTables\Facades\DataTables;

class DesaController extends Controller
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

                $items = array();
                foreach ($kecamatan as $kec) {
                    array_push($items, [
                        'id' => $kec->id,
                        'text' => $kec->nama,
                    ]);
                }

                return response()->json([
                    'items' => $items,
                ]);
            }

            $desa = Desa::query()->with(['kecamatan']);
            return DataTables::eloquent($desa)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $edit = view('components.edit', ['url' => route('admin.desa.edit', $row->id)]);
                    $delete = view('components.delete', ['url' => route('admin.desa.destroy', $row->id)]);
                    return $edit.$delete;
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.desa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.desa.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DesaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DesaRequest $request)
    {
        $fields = $request->getFields();

        if (Desa::create($fields)) {
            return redirect()->route('admin.desa.index')->with('alert', [
                'color' => 'success',
                'content' => trans('desa.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('alert', [
            'color' => 'danger',
            'content' => trans('desa.messages.errors.create'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wilayah\Desa $desa
     * @return \Illuminate\Http\Response
     */
    public function edit(Desa $desa)
    {
        return view('admin.desa.form', compact(['desa']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DesaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DesaRequest $request, $id)
    {
        if (!$desa = Desa::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('desa.messages.errors.not_found'),
            ]);
        }

        $fields = $request->getFields();
        if ($desa->update($fields)) {
            return redirect()->route('admin.desa.index')->with('alert', [
                'color' => 'success',
                'content' => trans('desa.messages.success.update'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('desa.messages.errors.update'),
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
        if (!$desa = Desa::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('desa.messages.errors.not_found'),
            ]);
        }

        if($desa->delete()) {
            return redirect()->back()->with('alert', [
                'color' => 'success',
                'content' => trans('desa.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('desa.messages.errors.delete'),
        ]);
    }
}
