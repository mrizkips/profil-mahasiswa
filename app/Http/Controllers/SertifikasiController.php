<?php

namespace App\Http\Controllers;

use App\Http\Requests\SertifikasiRequest;
use App\Models\Semester;
use App\Models\Sertifikasi;
use App\Traits\Uploadable;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SertifikasiController extends Controller
{
    use Uploadable;

    /**
     * Upload file path.
     *
     * @var string
     */
    protected $upload_path = 'sertifikasi/';

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $sertifikasi = Sertifikasi::query()->with(['semester', 'semester.tahun_akademik']);
            return DataTables::eloquent($sertifikasi)
                ->addIndexColumn()
                ->addColumn('view_upload', function($row) {
                    return '<a href="'.route("sertifikasi.view_upload", $row->id).'" class="btn btn-link">Lihat file</a>';
                })
                ->addColumn('action', function($row) {
                    $edit = view('components.edit', ['url' => route('sertifikasi.edit', $row->id)]);
                    $delete = view('components.delete', ['url' => route('sertifikasi.destroy', $row->id)]);
                    return $edit.$delete;
                })
                ->rawColumns(['view_upload', 'action'])
                ->make();
        }

        return view('sertifikasi.index');
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
        return view('sertifikasi.form', compact('request', 'semester'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SertifikasiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SertifikasiRequest $request)
    {
        $fields = $request->getFields();
        $username = auth('mahasiswa')->user()->username;

        if ($request->hasFile('file_upload')) {
            $filename = $this->uploadFile($request->file('file_upload'), null, $this->upload_path.$username);
            $fields['file_upload'] = $filename;
        }

        if (Sertifikasi::create($fields)) {
            return redirect()->route('sertifikasi.index')->with('alert', [
                'color' => 'success',
                'content' => trans('sertifikasi.messages.success.create'),
            ]);
        }

        if (isset($fields['file_upload'])) {
            $this->deleteFile($filename);
        }

        return redirect()->back()->withInput()->with('alert', [
            'color' => 'danger',
            'content' => trans('sertifikasi.messages.errors.create'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sertifikasi  $sertifikasi
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Sertifikasi $sertifikasi, Request $request)
    {
        $semester = Semester::where('mahasiswa_id', auth('mahasiswa')->id())->get();
        return view('sertifikasi.form', compact('request', 'semester', 'sertifikasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SertifikasiRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SertifikasiRequest $request, $id)
    {
        if (!$sertifikasi = Sertifikasi::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('sertifikasi.messages.errors.not_found'),
            ]);
        }

        $username = auth('mahasiswa')->user()->username;
        $old_image = $sertifikasi->file_upload;
        $fields = $request->getFields();

        if ($request->hasFile('file_upload')) {
            $filename = $this->uploadFile($request->file('file_upload'), null, $this->upload_path.$username);
            $fields['file_upload'] = $filename;
        }

        if ($sertifikasi->update($fields)) {
            if ($request->hasFile('file_upload')) {
                $this->deleteFile($old_image);
            }

            return redirect()->route('sertifikasi.index')->with('alert', [
                'color' => 'success',
                'content' => trans('sertifikasi.messages.success.update'),
            ]);
        }

        if (isset($fields['file_upload'])) {
            $this->deleteFile($filename);
        }

        return redirect()->back()->withInput()->with('alert', [
            'color' => 'danger',
            'content' => trans('sertifikasi.messages.errors.update'),
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
        if (!$sertifikasi = Sertifikasi::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('sertifikasi.messages.errors.not_found'),
            ]);
        }
        $file = $sertifikasi->file_upload;
        if($sertifikasi->delete()) {
            $this->deleteFile($file);
            return redirect()->back()->with('alert', [
                'color' => 'success',
                'content' => trans('sertifikasi.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('sertifikasi.messages.errors.delete'),
        ]);
    }

    /**
     * Show uploaded file from storage.
     *
     * @param \App\Models\Sertifikasi $sertifikasi
     * @return \Illuminate\Http\Response
     */
    public function view_upload(Sertifikasi $sertifikasi)
    {
        if ($this->existsFile($sertifikasi->file_upload)) {
            return response()->file('storage/'.$sertifikasi->file_upload);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('sertifikasi.messages.errors.not_found'),
        ]);
    }
}
