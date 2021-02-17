<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kegiatan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'semester_id', 'nama', 'penyelenggara', 'tingkat', 'file_upload',
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
        return $query->join('semester', 'semester.id', '=', 'kegiatan.semester_id')->where('mahasiswa_id', $mahasiswa_id);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }
}
