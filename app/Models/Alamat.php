<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{

    protected $table = 'alamat';

    protected $fillable = [
        'user_id', 'nama', 'penerima', 'phone', 'kelurahan_id', 'alamat', 'kd_pos', 'is_utama',
    ];
    protected $appends = [
        'daerah'
    ];

    public function kelurahan()
    {
        return $this->belongsTo('App\Models\Kelurahan', 'kelurahan_id', 'id');
    }

    public function getDaerahAttribute($value)
    {
        $daerah = '';
        $daerah .= ucwords(strtolower($this->kelurahan->kecamatan->kota->provinsi->name)).', ';
        $daerah .= ucwords(strtolower($this->kelurahan->kecamatan->kota->name)).', Kec. ';
        $daerah .= ucwords(strtolower($this->kelurahan->kecamatan->name)).', ';
        $daerah .= ucwords(strtolower($this->kelurahan->name));
        return  $daerah;
    }

}
