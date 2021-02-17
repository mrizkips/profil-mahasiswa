<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'semester';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipe', 'mahasiswa_id', 'tahun_akademik_id',
    ];

    /**
     * Membatasi query semester dengan id mahasiswa.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfMahasiswaId($query, $mahasiswa_id)
    {
        return $query->where('mahasiswa_id', $mahasiswa_id);
    }

    public function tahun_akademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'tahun_akademik_id', 'id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }

    public function krs()
    {
        return $this->hasOne(Krs::class);
    }

    public function ekstrakurikuler_mhs()
    {
        return $this->hasMany(EkstrakurikulerMhs::class);
    }

    public function sertifikasi()
    {
        return $this->hasMany(Sertifikasi::class);
    }

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class);
    }
}
