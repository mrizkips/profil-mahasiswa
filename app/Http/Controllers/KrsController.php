<?php

namespace App\Http\Controllers;

use App\Http\Requests\KrsRequest;
use App\Models\Krs;
use App\Models\Semester;
use App\Traits\Uploadable;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KrsController extends Controller
{
    use Uploadable;

    /**
     * Upload file path.
     *
     * @var string
     */
    protected $upload_path = 'krs/';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $krs = Krs::query()->with(['semester', 'semester.tahun_akademik']);
            return DataTables::eloquent($krs)
                ->addIndexColumn()
                ->addColumn('view_upload', function($row) {
                    return '<a href="'.route("krs.view_upload", $row->id).'" class="btn btn-link">Lihat file</a>';
                })
                ->addColumn('action', function($row) {
                    $edit = view('components.edit', ['url' => route('krs.edit', $row->id)]);
                    $delete = view('components.delete', ['url' => route('krs.destroy', $row->id)]);
                    return $edit.$delete;
                })
                ->rawColumns(['view_upload', 'action'])
                ->make();
        }

        return view('krs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $semester = Semester::where('mahasiswa_id', auth('mahasiswa')->id())->get();
        return view('krs.form', compact('request', 'semester'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\KrsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KrsRequest $request)
    {
        $fields = $request->getFields();
        $username = auth('mahasiswa')->user()->username;

        if ($check = Krs::where('semester_id', $request->input('semester_id'))->exists()) {
            return redirect()->back()->withInput()->with('alert', [
                'color' => 'danger',
                'content' => trans('krs.messages.errors.exists'),
            ]);
        }

        if ($request->hasFile('file_upload')) {
            $filename = $this->uploadFile($request->file('file_upload'), null, $this->upload_path.$username);
            $fields['file_upload'] = $filename;
        }

        if (Krs::create($fields)) {
            return redirect()->route('krs.index')->with('alert', [
                'color' => 'success',
                'content' => trans('krs.messages.success.create'),
            ]);
        }

        if (isset($fields['file_upload'])) {
            $this->deleteFile($filename);
        }

        return redirect()->back()->withInput()->with('alert', [
            'color' => 'danger',
            'content' => trans('krs.messages.errors.create'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Krs  $krs
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Krs $krs, Request $request)
    {
        $semester = Semester::where('mahasiswa_id', auth('mahasiswa')->id())->get();
        return view('krs.form', compact('request', 'semester', 'krs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\KrsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KrsRequest $request, $id)
    {
        if (!$krs = Krs::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('krs.messages.errors.not_found'),
            ]);
        }

        $username = auth('mahasiswa')->user()->username;
        $old_image = $krs->file_upload;
        $fields = $request->getFields();

        if ($request->hasFile('file_upload')) {
            $filename = $this->uploadFile($request->file('file_upload'), null, $this->upload_path.$username);
            $fields['file_upload'] = $filename;
        }

        if ($krs->update($fields)) {
            if ($request->hasFile('file_upload')) {
                $this->deleteFile($old_image);
            }

            return redirect()->route('krs.index')->with('alert', [
                'color' => 'success',
                'content' => trans('krs.messages.success.update'),
            ]);
        }

        if (isset($fields['file_upload'])) {
            $this->deleteFile($filename);
        }

        return redirect()->back()->withInput()->with('alert', [
            'color' => 'danger',
            'content' => trans('krs.messages.errors.update'),
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
        if (!$krs = Krs::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('krs.messages.errors.not_found'),
            ]);
        }
        $username = auth('mahasiswa')->user()->username;
        $dir = $this->upload_path.$username;
        if($krs->delete()) {
            $this->deleteDir($dir);
            return redirect()->back()->with('alert', [
                'color' => 'success',
                'content' => trans('krs.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('krs.messages.errors.delete'),
        ]);
    }

    /**
     * Show uploaded file from storage.
     *
     * @param \App\Models\Krs
     * @return \Illuminate\Http\Response
     */
    public function view_upload(Krs $krs)
    {
        if ($this->existsFile($krs->file_upload)) {
            return response()->file('storage/'.$krs->file_upload);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('krs.messages.errors.not_found'),
        ]);
    }
}
