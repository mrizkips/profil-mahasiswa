<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GantiPasswordRequest;
use App\Models\Admin;
use App\Models\Ekstrakurikuler;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\TahunAkademik;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Show admin dashboard
     *
     * @return Illuminate\Http\Response
     */
    public function index() {
        $user = auth('admin')->user();
        $mahasiswa = Mahasiswa::query();
        $jurusan = Jurusan::query();
        $tahun_akademik = TahunAkademik::query();
        $ekstrakurikuler = Ekstrakurikuler::query();
        return view('admin.home', compact(
            'user', 'mahasiswa', 'jurusan', 'tahun_akademik', 'ekstrakurikuler'
        ));
    }

    /**
     * Show ganti password view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ganti_password()
    {
        $admin = auth('admin')->user();
        return view('ganti_password', compact('admin'));
    }

    /**
     * Show profil mahasiswa.
     *
     * @param \App\Http\Requests\GantiPasswordRequest $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function password_update(GantiPasswordRequest $request)
    {
        $admin = Admin::findOrFail(auth('admin')->id());
        if ($admin->update(['password' => Hash::make($request->input('password'))])) {
            return redirect()->route('admin.ganti_password')->with('alert', [
                'color' => 'success',
                'content' => trans('passwords.messages.success.update'),
            ]);
        };

        return redirect()->back()->with('alert', [
            'color' => 'danger',
            'content' => trans('passwords.messages.errors.update'),
        ]);
    }
}
