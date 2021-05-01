<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $table = 'reg_regencies';

    public function provinsi()
    {
        return $this->belongsTo('App\Models\Provinsi', 'province_id', 'id');
    }
}
