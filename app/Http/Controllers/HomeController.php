<?php

namespace App\Http\Controllers;

use App\Http\Requests\GantiPasswordRequest;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show profil mahasiswa view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function mahasiswa()
    {
        $mahasiswa = auth('mahasiswa')->user();
        return view('mahasiswa', compact('mahasiswa'));
    }

    /**
     * Show ganti password view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ganti_password()
    {
        $mahasiswa = auth('mahasiswa')->user();
        return view('ganti_password', compact('mahasiswa'));
    }

    /**
     * Show profil mahasiswa.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function password_update(GantiPasswordRequest $request)
    {
        $mahasiswa = Mahasiswa::findOrFail(auth('mahasiswa')->id());
        if ($mahasiswa->update(['password' => Hash::make($request->input('password'))])) {
            return redirect()->route('ganti_password')->with('alert', [
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
