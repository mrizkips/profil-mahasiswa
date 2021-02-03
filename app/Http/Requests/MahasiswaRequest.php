<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MahasiswaRequest extends FormRequest
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
            'status_mhs' => 'required',
            'asal_sekolah' => 'required|string',
            'jurusan_asal' => 'required|string',
            'jurusan_id' => 'required|exists:jurusan,id',
            'no_test' => 'required|max:8',
            'thn_masuk' => 'required|max:4',
            'username' => 'required',
            'jen_kel' => 'required|in:l,p',
            'alamat' => 'required',
            'provinsi_id' => 'required|exists:provinsi,id',
            'kabkota_id' => 'required|exists:kabkota,id',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'desa_id' => 'required|exists:desa,id',
            'kode_pos' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kabkota_lahir_id' => 'required|exists:kabkota,id',
            'tgl_lahir' => 'required|date',
            'pekerjaan_id' => 'required|exists:pekerjaan,id',
            'telp' => 'nullable|alpha_num',
            'no_hp' => 'required|alpha_num',
            'kontak_lain' => 'nullable|alpha_num',
            'email' => 'nullable|email',
            'website' => 'nullable',
            'asal_pemasaran_id' => 'required|exists:asal_pemasaran,id',
            'pas_foto' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
            'nama_ayah' => 'required|string',
            'nama_ibu' => 'required|string',
            'pekerjaan_ayah_id' => 'required|exists:pekerjaan,id',
            'pekerjaan_ibu_id' => 'required|exists:pekerjaan,id',
            'alamat_wali' => 'required',
            'provinsi_wali_id' => 'required|exists:provinsi,id',
            'kabkota_wali_id' => 'required|exists:kabkota,id',
            'kecamatan_wali_id' => 'required|exists:kecamatan,id',
            'desa_wali_id' => 'required|exists:desa,id',
            'kode_pos_wali' => 'required',
            'rt_wali' => 'required',
            'rw_wali' => 'required',
            'telp_wali' => 'nullable|alpha_num',
            'no_hp_wali' => 'required|alpha_num',
            'kontak_lain_wali' => 'nullable|alpha_num',
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
            'status_mhs' => trans('mahasiswa.fields.status_mhs'),
            'asal_sekolah' => trans('mahasiswa.fields.asal_sekolah'),
            'jurusan_asal' => trans('mahasiswa.fields.jurusan_asal'),
            'jurusan_id' => trans('mahasiswa.fields.jurusan_id'),
            'no_test' => trans('mahasiswa.fields.no_test'),
            'thn_masuk' => trans('mahasiswa.fields.thn_masuk'),
            'username' => trans('mahasiswa.fields.username'),
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
            'pekerjaan_id' => trans('mahasiswa.fields.pekerjaan_id'),
            'telp' => trans('mahasiswa.fields.telp'),
            'no_hp' => trans('mahasiswa.fields.no_hp'),
            'kontak_lain' => trans('mahasiswa.fields.kontak_lain'),
            'email' => trans('mahasiswa.fields.email'),
            'website' => trans('mahasiswa.fields.website'),
            'asal_pemasaran_id' => trans('mahasiswa.fields.asal_pemasaran_id'),
            'pas_foto' => trans('mahasiswa.fields.pas_foto'),
            'nama_ayah' => trans('mahasiswa.fields.nama_ayah'),
            'nama_ibu' => trans('mahasiswa.fields.nama_ibu'),
            'pekerjaan_ayah_id' => trans('mahasiswa.fields.pekerjaan_ayah_id'),
            'pekerjaan_ibu_id' => trans('mahasiswa.fields.pekerjaan_ibu_id'),
            'alamat_wali' => trans('mahasiswa.fields.alamat_wali'),
            'provinsi_wali_id' => trans('mahasiswa.fields.provinsi_wali_id'),
            'kabkota_wali_id' => trans('mahasiswa.fields.kabkota_wali_id'),
            'kecamatan_wali_id' => trans('mahasiswa.fields.kecamatan_wali_id'),
            'desa_wali_id' => trans('mahasiswa.fields.desa_wali_id'),
            'kode_pos_wali' => trans('mahasiswa.fields.kode_pos_wali'),
            'rt_wali' => trans('mahasiswa.fields.rt_wali'),
            'rw_wali' => trans('mahasiswa.fields.rw_wali'),
            'telp_wali' => trans('mahasiswa.fields.telp_wali'),
            'no_hp_wali' => trans('mahasiswa.fields.no_hp_wali'),
            'kontak_lain_wali' => trans('mahasiswa.fields.kontak_lain_wali'),
        ];
    }

    public function getFields()
    {
        $fields = [
            'nama',
            'status_mhs',
            'asal_sekolah',
            'jurusan_asal',
            'jurusan_id',
            'no_test',
            'thn_masuk',
            'username',
            'jen_kel',
            'alamat',
            'provinsi_id',
            'kabkota_id',
            'kecamatan_id',
            'desa_id',
            'kode_pos',
            'rt',
            'rw',
            'kabkota_lahir_id',
            'tgl_lahir',
            'pekerjaan_id',
            'telp',
            'no_hp',
            'kontak_lain',
            'email',
            'website',
            'asal_pemasaran_id',
            'pas_foto',
            'nama_ayah',
            'nama_ibu',
            'pekerjaan_ayah_id',
            'pekerjaan_ibu_id',
            'alamat_wali',
            'provinsi_wali_id',
            'kabkota_wali_id',
            'kecamatan_wali_id',
            'desa_wali_id',
            'kode_pos_wali',
            'rt_wali',
            'rw_wali',
            'telp_wali',
            'no_hp_wali',
            'kontak_lain_wali',
        ];
        return $this->only($fields);
    }
}
