<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EkstrakurikulerMhs extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ekstrakurikuler_mhs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ekstrakurikuler_id', 'semester_id', 'jabatan',
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
        return $query->join('semester', 'semester.id', '=', 'ekstrakurikuler_mhs.semester_id')->where('mahasiswa_id', $mahasiswa_id);
    }

    public function ekstrakurikuler()
    {
        return $this->belongsTo(Ekstrakurikuler::class, 'ekstrakurikuler_id', 'id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }
}
