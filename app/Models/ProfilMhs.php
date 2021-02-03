<?php

namespace App\Models;

use App\Models\Wilayah\Desa;
use App\Models\Wilayah\KabKota;
use App\Models\Wilayah\Kecamatan;
use App\Models\Wilayah\Provinsi;
use Illuminate\Database\Eloquent\Model;

class ProfilMhs extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profil_mhs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mahasiswa_id', 'nama', 'jen_kel', 'tgl_lahir',
        'kabkota_lahir_id', 'pekerjaan_id', 'asal_sekolah',
        'jurusan_asal', 'status_mhs', 'jurusan_id',
        'no_test', 'thn_masuk', 'semester',
        'asal_pemasaran_id', 'alamat', 'rt', 'rw',
        'provinsi_id', 'kabkota_id', 'kecamatan_id', 'desa_id',
        'kode_pos', 'telp', 'no_hp', 'kontak_lain',
        'email', 'website', 'nama_ayah', 'nama_ibu',
        'pekerjaan_ayah_id', 'pekerjaan_ibu_id',
        'alamat_wali', 'rt_wali', 'rw_wali',
        'provinsi_wali_id', 'kabkota_wali_id', 'kecamatan_wali_id',
        'desa_wali_id', 'kode_pos_wali', 'telp_wali',
        'no_hp_wali', 'kontak_lain_wali', 'pas_foto',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'id');
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id', 'id');
    }

    public function kabkota()
    {
        return $this->belongsTo(KabKota::class, 'kabkota_id', 'id');

    }

    public function kabkota_lahir()
    {
        return $this->belongsTo(KabKota::class, 'kabkota_lahir_id', 'id');

    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id');
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id', 'id');
    }

    public function asal_pemasaran()
    {
        return $this->belongsTo(AsalPemasaran::class, 'asal_pemasaran_id', 'id');
    }

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id', 'id');
    }

    public function pekerjaan_ayah()
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_ayah_id', 'id');
    }

    public function pekerjaan_ibu()
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_ibu_id', 'id');
    }

    public function provinsi_wali()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_wali_id', 'id');
    }

    public function kabkota_wali()
    {
        return $this->belongsTo(KabKota::class, 'kabkota_wali_id', 'id');

    }

    public function kecamatan_wali()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_wali_id', 'id');
    }

    public function desa_wali()
    {
        return $this->belongsTo(Desa::class, 'desa_wali_id', 'id');
    }
}
