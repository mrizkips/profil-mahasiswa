<?php

namespace App\Models;

use App\Models\Wilayah\Desa;
use App\Models\Wilayah\KabKota;
use App\Models\Wilayah\Kecamatan;
use App\Models\Wilayah\Provinsi;
use Illuminate\Database\Eloquent\Model;

class ProfilAdmin extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profil_admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id', 'nama', 'jen_kel', 'tgl_lahir',
        'kabkota_lahir_id', 'alamat', 'rt', 'rw',
        'provinsi_id', 'kabkota_id', 'kecamatan_id',
        'desa_id', 'kode_pos', 'telp', 'no_hp',
        'kontak_lain', 'pas_foto',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
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
}
