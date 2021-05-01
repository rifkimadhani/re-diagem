<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = 'reg_provinces';

    public function kota()
    {
        return $this->hasMany('App\Models\Kota', 'id', 'regency_id');
    }

}
