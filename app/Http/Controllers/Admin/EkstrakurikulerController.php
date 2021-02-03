<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EkstrakurikulerRequest;
use App\Models\Ekstrakurikuler;

class EkstrakurikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ekstrakurikuler = Ekstrakurikuler::orderBy('id', 'desc')->paginate()->onEachSide(2);
        return view('admin.ekstrakurikuler.index', compact('ekstrakurikuler'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ekstrakurikuler.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\EkstrakurikulerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EkstrakurikulerRequest $request)
    {
        $fields = $request->getFields();

        if (Ekstrakurikuler::create($fields)) {
            return redirect()->route('admin.ekstrakurikuler.index')->with('alert', [
                'color' => 'success',
                'content' => trans('ekstrakurikuler.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('alert', [
            'color' => 'danger',
            'content' => trans('ekstrakurikuler.messages.errors.create'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ekstrakurikuler  $ekstrakurikuler
     * @return \Illuminate\Http\Response
     */
    public function edit(Ekstrakurikuler $ekstrakurikuler)
    {
        return view('admin.ekstrakurikuler.form', compact('ekstrakurikuler'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EkstrakurikulerRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EkstrakurikulerRequest $request, $id)
    {
        if (!$ekstrakurikuler = Ekstrakurikuler::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('ekstrakurikuler.messages.errors.not_found'),
            ]);
        }

        $fields = $request->getFields();
        if ($ekstrakurikuler->update($fields)) {
            return redirect()->route('admin.ekstrakurikuler.index')->with('alert', [
                'color' => 'success',
                'content' => trans('ekstrakurikuler.messages.success.update'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('ekstrakurikuler.messages.errors.update'),
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
        if (!$ekstrakurikuler = Ekstrakurikuler::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('ekstrakurikuler.messages.errors.not_found'),
            ]);
        }

        if($ekstrakurikuler->delete()) {
            return redirect()->back()->with('alert', [
                'color' => 'success',
                'content' => trans('ekstrakurikuler.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('ekstrakurikuler.messages.errors.delete'),
        ]);
    }
}
