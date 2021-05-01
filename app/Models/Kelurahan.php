<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = 'reg_villages';

    public function kecamatan()
    {
        return $this->belongsTo('App\Models\Kecamatan', 'district_id', 'id');
    }
}
