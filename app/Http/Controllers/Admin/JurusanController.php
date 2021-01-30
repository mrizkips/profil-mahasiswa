<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\JurusanRequest;
use App\Models\Jurusan;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurusan = Jurusan::orderBy('id', 'desc')->paginate()->onEachSide(3);
        return view('admin.jurusan.index', [
            'jurusan' => $jurusan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jurusan.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\JurusanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JurusanRequest $request)
    {
        $fields = $request->getFields();

        if (Jurusan::create($fields)) {
            return redirect()->route('admin.jurusan.index')->with('alert', [
                'color' => 'success',
                'content' => trans('jurusan.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('alert', [
            'color' => 'danger',
            'content' => trans('jurusan.messages.errors.create'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jurusan $jurusan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurusan $jurusan)
    {
        return view('admin.jurusan.form', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\JurusanRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JurusanRequest $request, $id)
    {
        if (!$jurusan = Jurusan::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('jurusan.messages.errors.not_found'),
            ]);
        }

        $fields = $request->getFields();
        if ($jurusan->update($fields)) {
            return redirect()->route('admin.jurusan.index')->with('alert', [
                'color' => 'success',
                'content' => trans('jurusan.messages.success.update'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('jurusan.messages.errors.update'),
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
        if (!$jurusan = Jurusan::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('jurusan.messages.errors.not_found'),
            ]);
        }

        if($jurusan->delete()) {
            return redirect()->back()->with('alert', [
                'color' => 'success',
                'content' => trans('jurusan.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('jurusan.messages.errors.delete'),
        ]);
    }
}
