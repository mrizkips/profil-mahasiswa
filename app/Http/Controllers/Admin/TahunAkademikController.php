<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\JurusanRequest;
use App\Http\Requests\TahunAkademikRequest;
use App\Models\TahunAkademik;

class TahunAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun_akademik = TahunAkademik::orderBy('id', 'desc')->paginate()->onEachSide(2);
        return view('admin.tahun_akademik.index', compact('tahun_akademik'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tahun_akademik.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TahunAkademikRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TahunAkademikRequest $request)
    {
        $fields = $request->getFields();

        if (TahunAkademik::create($fields)) {
            return redirect()->route('admin.tahun_akademik.index')->with('alert', [
                'color' => 'success',
                'content' => trans('tahun_akademik.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('alert', [
            'color' => 'danger',
            'content' => trans('tahun_akademik.messages.errors.create'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TahunAkademik  $tahun_akademik
     * @return \Illuminate\Http\Response
     */
    public function edit(TahunAkademik $tahun_akademik)
    {
        return view('admin.tahun_akademik.form', compact('tahun_akademik'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TahunAkademikRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TahunAkademikRequest $request, $id)
    {
        if (!$tahun_akademik = TahunAkademik::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('tahun_akademik.messages.errors.not_found'),
            ]);
        }

        $fields = $request->getFields();
        if ($tahun_akademik->update($fields)) {
            return redirect()->route('admin.tahun_akademik.index')->with('alert', [
                'color' => 'success',
                'content' => trans('tahun_akademik.messages.success.update'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('tahun_akademik.messages.errors.update'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$tahun_akademik = TahunAkademik::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('tahun_akademik.messages.errors.not_found'),
            ]);
        }

        if($tahun_akademik->delete()) {
            return redirect()->back()->with('alert', [
                'color' => 'success',
                'content' => trans('tahun_akademik.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('tahun_akademik.messages.errors.delete'),
        ]);
    }
}
