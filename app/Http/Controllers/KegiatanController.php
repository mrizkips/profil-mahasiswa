<?php

namespace App\Http\Controllers;

use App\Http\Requests\KegiatanRequest;
use App\Models\Kegiatan;
use App\Models\Semester;
use App\Traits\Uploadable;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KegiatanController extends Controller
{
    use Uploadable;

    /**
     * Upload file path.
     *
     * @var string
     */
    protected $upload_path = 'kegiatan/';

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $kegiatan = Kegiatan::query()->with(['semester', 'semester.tahun_akademik']);
            return DataTables::eloquent($kegiatan)
                ->addIndexColumn()
                ->addColumn('view_upload', function($row) {
                    return '<a href="'.route("kegiatan.view_upload", $row->id).'" class="btn btn-link">Lihat file</a>';
                })
                ->addColumn('action', function($row) {
                    $edit = view('components.edit', ['url' => route('kegiatan.edit', $row->id)]);
                    $delete = view('components.delete', ['url' => route('kegiatan.destroy', $row->id)]);
                    return $edit.$delete;
                })
                ->rawColumns(['view_upload', 'action'])
                ->make();
        }

        return view('kegiatan.index');
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
        return view('kegiatan.form', compact('request', 'semester'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\KegiatanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KegiatanRequest $request)
    {
        $fields = $request->getFields();
        $username = auth('mahasiswa')->user()->username;

        if ($request->hasFile('file_upload')) {
            $filename = $this->uploadFile($request->file('file_upload'), null, $this->upload_path.$username);
            $fields['file_upload'] = $filename;
        }

        if (Kegiatan::create($fields)) {
            return redirect()->route('kegiatan.index')->with('alert', [
                'color' => 'success',
                'content' => trans('kegiatan.messages.success.create'),
            ]);
        }

        if (isset($fields['file_upload'])) {
            $this->deleteFile($filename);
        }

        return redirect()->back()->withInput()->with('alert', [
            'color' => 'danger',
            'content' => trans('kegiatan.messages.errors.create'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Kegiatan $kegiatan, Request $request)
    {
        $semester = Semester::where('mahasiswa_id', auth('mahasiswa')->id())->get();
        return view('kegiatan.form', compact('request', 'semester', 'kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\KegiatanRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KegiatanRequest $request, $id)
    {
        if (!$kegiatan = Kegiatan::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('kegiatan.messages.errors.not_found'),
            ]);
        }

        $username = auth('mahasiswa')->user()->username;
        $old_image = $kegiatan->file_upload;
        $fields = $request->getFields();

        if ($request->hasFile('file_upload')) {
            $filename = $this->uploadFile($request->file('file_upload'), null, $this->upload_path.$username);
            $fields['file_upload'] = $filename;
        }

        if ($kegiatan->update($fields)) {
            if ($request->hasFile('file_upload')) {
                $this->deleteFile($old_image);
            }

            return redirect()->route('kegiatan.index')->with('alert', [
                'color' => 'success',
                'content' => trans('kegiatan.messages.success.update'),
            ]);
        }

        if (isset($fields['file_upload'])) {
            $this->deleteFile($filename);
        }

        return redirect()->back()->withInput()->with('alert', [
            'color' => 'danger',
            'content' => trans('kegiatan.messages.errors.update'),
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
        if (!$kegiatan = Kegiatan::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('kegiatan.messages.errors.not_found'),
            ]);
        }
        $file = $kegiatan->file_upload;
        if($kegiatan->delete()) {
            $this->deleteFile($file);
            return redirect()->back()->with('alert', [
                'color' => 'success',
                'content' => trans('kegiatan.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('kegiatan.messages.errors.delete'),
        ]);
    }

    /**
     * Show uploaded file from storage.
     *
     * @param \App\Models\Kegiatan $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function view_upload(Kegiatan $kegiatan)
    {
        if ($this->existsFile($kegiatan->file_upload)) {
            return response()->file('storage/'.$kegiatan->file_upload);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('kegiatan.messages.errors.not_found'),
        ]);
    }
}
