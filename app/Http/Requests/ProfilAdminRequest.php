<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfilAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => 'required|string',
            'jen_kel' => 'required|in:l,p',
            'alamat' => 'required',
            'provinsi_id' => 'required|exists:provinsi,id',
            'kabkota_id' => 'required|exists:kabkota,id',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'desa_id' => 'required|exists:desa,id',
            'kode_pos' => 'required',
            'rt' => 'nullable',
            'rw' => 'nullable',
            'kabkota_lahir_id' => 'required|exists:kabkota,id',
            'tgl_lahir' => 'required|date',
            'telp' => 'nullable|alpha_num',
            'no_hp' => 'nullable|alpha_num',
            'kontak_lain' => 'nullable|alpha_num',
            'pas_foto' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'nama' => trans('mahasiswa.fields.nama'),
            'jen_kel' => trans('mahasiswa.fields.jen_kel'),
            'alamat' => trans('mahasiswa.fields.alamat'),
            'provinsi_id' => trans('mahasiswa.fields.provinsi_id'),
            'kabkota'=> trans('mahasiswa.fields.kabkota_id'),
            'kecamatan_id' => trans('mahasiswa.fields.kecamatan_id'),
            'desa_id' => trans('mahasiswa.fields.desa_id'),
            'kode_pos' => trans('mahasiswa.fields.kode_pos'),
            'rt' => trans('mahasiswa.fields.rt'),
            'rw' => trans('mahasiswa.fields.rw'),
            'kabkota_lahir_id' => trans('mahasiswa.fields.kabkota_lahir_id'),
            'tgl_lahir' => trans('mahasiswa.fields.tgl_lahir'),
            'telp' => trans('mahasiswa.fields.telp'),
            'no_hp' => trans('mahasiswa.fields.no_hp'),
            'kontak_lain' => trans('mahasiswa.fields.kontak_lain'),
            'pas_foto' => trans('mahasiswa.fields.pas_foto'),
        ];
    }
}
