<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilAdminRequest;
use App\Models\Admin;
use App\Services\AdminService;
use App\Traits\Uploadable;

class ProfilAdminController extends Controller
{
    use Uploadable;

    /**
     * Upload file path variable.
     *
     * @var string
     */
    protected $image_path = 'admin/';

    /**
     * Menampilkan data profil
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = auth('admin')->user();
        $profil_admin = $admin->profil_admin;
        return view('admin.profil', compact('admin', 'profil_admin'));
    }

    /**
     * Update profil admin
     *
     * @param \App\Http\Requests\ProfilAdminRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(ProfilAdminRequest $request, AdminService $service)
    {
        $admin = auth('admin')->user();
        $old_image = $admin->profil_admin->pas_foto;
        $fields = $request->all();
        $fields['tgl_lahir'] = $fields['tgl_lahir'] ? date('Y-m-d', strtotime($fields['tgl_lahir'])) : null;

        if ($request->hasFile('pas_foto')) {
            $filename = $this->uploadFile($request->file('pas_foto'), null, $this->image_path.$admin->username);
            $fields['pas_foto'] = $filename;
        }

        if ($service->update($admin, array(), $fields)) {
            if ($request->hasFile('pas_foto')) {
                $this->deleteFile($old_image);
            }

            return redirect()->route('admin.profil.index')->with('alert', [
                'color' => 'success',
                'content' => trans('admin.messages.success.update'),
            ]);
        }

        if (isset($fields['pas_foto'])) {
            $this->deleteFile($filename);
        }

        return redirect()->back()->withInput()->with('alert', [
            'color' => 'danger',
            'content' => trans('admin.messages.errors.update'),
        ]);
    }
}
