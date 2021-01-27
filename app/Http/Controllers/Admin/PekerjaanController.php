<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PekerjaanRequest;
use App\Models\Pekerjaan;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pekerjaan = Pekerjaan::latest()->paginate();
        return view('admin.pekerjaan.index', [
            'pekerjaan' => $pekerjaan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pekerjaan.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PekerjaanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PekerjaanRequest $request)
    {
        $fields = $request->getFields();

        if (Pekerjaan::create($fields)) {
            return redirect()->route('admin.pekerjaan.index')->with('alert', [
                'color' => 'success',
                'content' => trans('pekerjaan.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('alert', [
            'color' => 'danger',
            'content' => trans('pekerjaan.messages.errors.create'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pekerjaan $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pekerjaan $pekerjaan)
    {
        return view('admin.pekerjaan.form', compact('pekerjaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PekerjaanRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PekerjaanRequest $request, $id)
    {
        if (!$pekerjaan = Pekerjaan::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('pekerjaan.messages.errors.not_found'),
            ]);
        }

        $fields = $request->getFields();
        if ($pekerjaan->update($fields)) {
            return redirect()->route('admin.pekerjaan.index')->with('alert', [
                'color' => 'success',
                'content' => trans('pekerjaan.messages.success.update'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('pekerjaan.messages.errors.update'),
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
        if (!$pekerjaan = Pekerjaan::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('pekerjaan.messages.errors.not_found'),
            ]);
        }

        if($pekerjaan->delete()) {
            return redirect()->back()->with('alert', [
                'color' => 'success',
                'content' => trans('pekerjaan.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('pekerjaan.messages.errors.delete'),
        ]);
    }
}
