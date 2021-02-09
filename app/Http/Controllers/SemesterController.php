<?php

namespace App\Http\Controllers;

use App\Http\Requests\SemesterRequest;
use App\Models\Semester;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $semester = Semester::query()->with(['tahun_akademik']);
            return DataTables::eloquent($semester)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $show = view('components.show', ['url' => route('semester.show', $row->id)]);
                    $edit = view('components.edit', ['url' => route('semester.edit', $row->id)]);
                    $delete = view('components.delete', ['url' => route('semester.destroy', $row->id)]);
                    return $show.$edit.$delete;
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('semester.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mahasiswa = auth('mahasiswa')->user();
        $tahun_akademik = TahunAkademik::orderBy('id', 'desc')->get();
        return view('semester.form', compact('mahasiswa', 'tahun_akademik'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SemesterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SemesterRequest $request)
    {
        $fields = $request->getFields();
        $fields['mahasiswa_id'] = auth('mahasiswa')->id();

        if (Semester::create($fields)) {
            return redirect()->route('semester.index')->with('alert', [
                'color' => 'success',
                'content' => trans('semester.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('alert', [
            'color' => 'danger',
            'content' => trans('semester.messages.errors.create'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Semester $semester
     * @return \Illuminate\Http\Response
     */
    public function show(Semester $semester)
    {
        return view('semester.show', compact('semester'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Semester $semester
     * @return \Illuminate\Http\Response
     */
    public function edit(Semester $semester)
    {
        $mahasiswa = auth('mahasiswa')->user();
        $tahun_akademik = TahunAkademik::orderBy('id', 'desc')->get();
        return view('semester.form', compact('mahasiswa', 'tahun_akademik', 'semester'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SemesterRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SemesterRequest $request, $id)
    {
        if (!$semester = Semester::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('semester.messages.errors.not_found'),
            ]);
        }

        $fields = $request->getFields();
        if ($semester->update($fields)) {
            return redirect()->route('semester.index')->with('alert', [
                'color' => 'success',
                'content' => trans('semester.messages.success.update'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('semester.messages.errors.update'),
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
        if (!$semester = Semester::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('semester.messages.errors.not_found'),
            ]);
        }

        if($semester->delete()) {
            return redirect()->back()->with('alert', [
                'color' => 'success',
                'content' => trans('semester.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('semester.messages.errors.delete'),
        ]);
    }
}
