<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'reg_districts';

    public function kota()
    {
        return $this->belongsTo('App\Models\Kota', 'regency_id', 'id');
    }
}
