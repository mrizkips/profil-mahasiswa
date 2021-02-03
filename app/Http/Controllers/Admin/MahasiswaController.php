<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MahasiswaRequest;
use App\Models\AsalPemasaran;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Pekerjaan;
use App\Services\MahasiswaService;
use App\Traits\Uploadable;
use Yajra\DataTables\Facades\DataTables;

class MahasiswaController extends Controller
{
    use Uploadable;

    /**
     * Upload file path variable.
     *
     * @var string
     */
    protected $image_path = 'mahasiswa/';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $mahasiswa = Mahasiswa::query()->with(['profil_mhs', 'profil_mhs.jurusan']);
            return DataTables::eloquent($mahasiswa)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $show = view('components.show', ['url' => route('admin.mahasiswa.show', $row->id)]);
                    $edit = view('components.edit', ['url' => route('admin.mahasiswa.edit', $row->id)]);
                    $delete = view('components.delete', ['url' => route('admin.mahasiswa.destroy', $row->id)]);
                    return $show.$edit.$delete;
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.mahasiswa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jurusan = Jurusan::all();
        $pekerjaan = Pekerjaan::all();
        $asal_pemasaran = AsalPemasaran::all();
        return view('admin.mahasiswa.form', compact('jurusan', 'pekerjaan', 'asal_pemasaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MahasiswaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MahasiswaRequest $request, MahasiswaService $service)
    {
        $fields = $request->getFields();
        $fields['tgl_lahir'] = $fields['tgl_lahir'] ? date('Y-m-d', strtotime($fields['tgl_lahir'])) : null;
        $fields['password'] = bcrypt($fields['username']);
        $fields['is_register'] = config('constants.is_register.false');

        if ($request->hasFile('pas_foto')) {
            $filename = $this->uploadFile($request->file('pas_foto'), null, $this->image_path.$fields['username']);
            $fields['pas_foto'] = $filename;
        }

        if ($service->create($fields)) {
            return redirect()->route('admin.mahasiswa.index')->with('alert', [
                'color' => 'success',
                'content' => trans('mahasiswa.messages.success.create'),
            ]);
        }

        if (isset($fields['pas_foto'])) {
            $this->deleteFile($filename);
        }

        return redirect()->back()->withInput()->with('alert', [
            'color' => 'danger',
            'content' => trans('mahasiswa.messages.errors.create'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $profil_mhs = $mahasiswa->profil_mhs;
        $jurusan = Jurusan::all();
        $pekerjaan = Pekerjaan::all();
        $asal_pemasaran = AsalPemasaran::all();
        return view('admin.mahasiswa.form', compact('mahasiswa', 'profil_mhs', 'jurusan', 'pekerjaan', 'asal_pemasaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MahasiswaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MahasiswaRequest $request, MahasiswaService $service, $id)
    {
        if (!$mahasiswa = Mahasiswa::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('mahasiswa.messages.errors.not_found'),
            ]);
        }

        $old_image = $mahasiswa->profil_mhs->pas_foto;
        $fields = $request->getFields();
        $fields['tgl_lahir'] = $fields['tgl_lahir'] ? date('Y-m-d', strtotime($fields['tgl_lahir'])) : null;

        if ($request->hasFile('pas_foto')) {
            $filename = $this->uploadFile($request->file('pas_foto'), null, $this->image_path.$fields['username']);
            $fields['pas_foto'] = $filename;
        }

        unset($fields['username']);
        if ($service->update($mahasiswa, array(), $fields)) {
            if ($request->hasFile('pas_foto')) {
                $this->deleteFile($old_image);
            }

            return redirect()->route('admin.mahasiswa.index')->with('alert', [
                'color' => 'success',
                'content' => trans('mahasiswa.messages.success.update'),
            ]);
        }

        if (isset($fields['pas_foto'])) {
            $this->deleteFile($filename);
        }

        return redirect()->back()->withInput()->with('alert', [
            'color' => 'danger',
            'content' => trans('mahasiswa.messages.errors.update'),
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
        if (!$mahasiswa = Mahasiswa::find($id)) {
            return redirect()->back()->with('alert', [
                'color' => 'danger',
                'content' => trans('mahasiswa.messages.errors.not_found'),
            ]);
        }

        $dir = $this->image_path.$mahasiswa->username;
        if($mahasiswa->delete()) {
            $this->deleteDir($dir);
            return redirect()->back()->with('alert', [
                'color' => 'success',
                'content' => trans('mahasiswa.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('mahasiswa.messages.errors.delete'),
        ]);
    }
}
