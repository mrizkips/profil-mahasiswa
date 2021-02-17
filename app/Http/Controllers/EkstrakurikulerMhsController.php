<?php

namespace App\Http\Controllers;

use App\Http\Requests\EkstrakurikulerMhsRequest;
use App\Models\Ekstrakurikuler;
use App\Models\EkstrakurikulerMhs;
use App\Models\Semester;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EkstrakurikulerMhsController extends Controller
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
            $ekstrakurikuler = EkstrakurikulerMhs::query()->with(['semester', 'semester.tahun_akademik', 'ekstrakurikuler']);
            return DataTables::eloquent($ekstrakurikuler)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $edit = view('components.edit', ['url' => route('ekstrakurikuler_mhs.edit', $row->id)]);
                    $delete = view('components.delete', ['url' => route('ekstrakurikuler_mhs.destroy', $row->id)]);
                    return $edit.$delete;
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('ekstrakurikuler_mhs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $ekstrakurikuler = Ekstrakurikuler::all();
        $semester = Semester::where('mahasiswa_id', auth('mahasiswa')->id())->get();
        return view('ekstrakurikuler_mhs.form', compact('request', 'semester', 'ekstrakurikuler'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\EkstrakurikulerMhsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EkstrakurikulerMhsRequest $request)
    {
        $fields = $request->getFields();

        if (EkstrakurikulerMhs::create($fields)) {
            return redirect()->route('ekstrakurikuler_mhs.index')->with('alert', [
                'color' => 'success',
                'content' => trans('ekstrakurikuler_mhs.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('alert', [
            'color' => 'danger',
            'content' => trans('ekstrakurikuler_mhs.messages.errors.create'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EkstrakurikulerMhs $ekstrakurikuler_mhs
     * @return \Illuminate\Http\Response
     */
    public function edit(EkstrakurikulerMhs $ekstrakurikuler_mhs, Request $request)
    {
        $ekstrakurikuler = Ekstrakurikuler::all();
        $semester = Semester::where('mahasiswa_id', auth('mahasiswa')->id())->get();
        return view('ekstrakurikuler_mhs.form', compact('request', 'semester', 'ekstrakurikuler', 'ekstrakurikuler_mhs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EkstrakurikulerMhsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EkstrakurikulerMhsRequest $request, $id)
    {
        if (!$ekstrakurikuler_mhs = EkstrakurikulerMhs::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('ekstrakurikuler_mhs.messages.errors.not_found'),
            ]);
        }

        $fields = $request->getFields();
        if ($ekstrakurikuler_mhs->update($fields)) {
            return redirect()->route('ekstrakurikuler_mhs.index')->with('alert', [
                'color' => 'success',
                'content' => trans('ekstrakurikuler_mhs.messages.success.update'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('ekstrakurikuler_mhs.messages.errors.update'),
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
        if (!$ekstrakurikuler_mhs = EkstrakurikulerMhs::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('ekstrakurikuler_mhs.messages.errors.not_found'),
            ]);
        }

        if($ekstrakurikuler_mhs->delete()) {
            return redirect()->back()->with('alert', [
                'color' => 'success',
                'content' => trans('ekstrakurikuler_mhs.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('ekstrakurikuler_mhs.messages.errors.delete'),
        ]);
    }
}
