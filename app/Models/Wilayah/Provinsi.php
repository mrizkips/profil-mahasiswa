<?php

namespace App\Models\Wilayah;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
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
    protected $table = 'provinsi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'nama'];
}
