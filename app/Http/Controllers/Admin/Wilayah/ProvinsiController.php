<?php

namespace App\Http\Controllers\Admin\Wilayah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProvinsiRequest;
use App\Http\Select2\Select2;
use App\Models\Wilayah\Provinsi;
use Yajra\DataTables\Facades\DataTables;

class ProvinsiController extends Controller
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
            if ($nama_provinsi = $request->get('provinsi')) {
                $provinsi = Provinsi::where('nama', 'like', "%$nama_provinsi%")->limit(5)->get();

                $select = new Select2();
                foreach ($provinsi as $prov) {
                    $select->option($prov->id, $prov->nama);
                }

                return $select->render();
            }

            $provinsi = Provinsi::query();
            return DataTables::eloquent($provinsi)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $edit = view('components.edit', ['url' => route('admin.provinsi.edit', $row->id)]);
                    $delete = view('components.delete', ['url' => route('admin.provinsi.destroy', $row->id)]);
                    return $edit.$delete;
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.provinsi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.provinsi.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProvinsiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProvinsiRequest $request)
    {
        $fields = $request->getFields();

        if (Provinsi::create($fields)) {
            return redirect()->route('admin.provinsi.index')->with('alert', [
                'color' => 'success',
                'content' => trans('provinsi.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('alert', [
            'color' => 'danger',
            'content' => trans('provinsi.messages.errors.create'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wilayah\Provinsi $provinsi
     * @return \Illuminate\Http\Response
     */
    public function edit(Provinsi $provinsi)
    {
        return view('admin.provinsi.form', compact('provinsi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProvinsiRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProvinsiRequest $request, $id)
    {
        if (!$provinsi = Provinsi::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('provinsi.messages.errors.not_found'),
            ]);
        }

        $fields = $request->getFields();
        if ($provinsi->update($fields)) {
            return redirect()->route('admin.provinsi.index')->with('alert', [
                'color' => 'success',
                'content' => trans('provinsi.messages.success.update'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('provinsi.messages.errors.update'),
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
        if (!$provinsi = Provinsi::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('provinsi.messages.errors.not_found'),
            ]);
        }

        if($provinsi->delete()) {
            return redirect()->back()->with('alert', [
                'color' => 'success',
                'content' => trans('provinsi.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('provinsi.messages.errors.delete'),
        ]);
    }
}
