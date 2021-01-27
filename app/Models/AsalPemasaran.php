<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsalPemasaran extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'asal_pemasaran';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
    ];
}
