<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AsalPemasaranRequest;
use App\Models\AsalPemasaran;

class AsalPemasaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asal_pemasaran = AsalPemasaran::orderBy('id', 'desc')->paginate()->onEachSide(2);
        return view('admin.asal_pemasaran.index', [
            'asal_pemasaran' => $asal_pemasaran,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.asal_pemasaran.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AsalPemasaranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AsalPemasaranRequest $request)
    {
        $fields = $request->getFields();

        if (AsalPemasaran::create($fields)) {
            return redirect()->route('admin.asal_pemasaran.index')->with('alert', [
                'color' => 'success',
                'content' => trans('asal_pemasaran.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('alert', [
            'color' => 'danger',
            'content' => trans('asal_pemasaran.messages.errors.create'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AsalPemasaran $asal_pemasaran
     * @return \Illuminate\Http\Response
     */
    public function edit(AsalPemasaran $asal_pemasaran)
    {
        return view('admin.asal_pemasaran.form', compact('asal_pemasaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AsalPemasaranRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AsalPemasaranRequest $request, $id)
    {
        if (!$asal_pemasaran = AsalPemasaran::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('asal_pemasaran.messages.errors.not_found'),
            ]);
        }

        $fields = $request->getFields();
        if ($asal_pemasaran->update($fields)) {
            return redirect()->route('admin.asal_pemasaran.index')->with('alert', [
                'color' => 'success',
                'content' => trans('asal_pemasaran.messages.success.update'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('asal_pemasaran.messages.errors.update'),
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
        if (!$asal_pemasaran = AsalPemasaran::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('asal_pemasaran.messages.errors.not_found'),
            ]);
        }

        if($asal_pemasaran->delete()) {
            return redirect()->back()->with('alert', [
                'color' => 'success',
                'content' => trans('asal_pemasaran.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('asal_pemasaran.messages.errors.delete'),
        ]);
    }
}
