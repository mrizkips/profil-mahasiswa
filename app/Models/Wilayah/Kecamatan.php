<?php

namespace App\Models\Wilayah;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    /**
     * The table associated with the model.
     *
     * @var array
     */
    protected $table = 'kecamatan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'nama', 'kabkota_id'];

    public function desa()
    {
        return $this->hasMany(Desa::class);
    }

    public function kabkota()
    {
        return $this->belongsTo(KabKota::class, 'kabkota_id', 'id');
    }
}
