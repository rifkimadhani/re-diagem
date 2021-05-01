<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Pengiriman extends Model
{
    use Uuid;

    protected $table = 'pengiriman';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'order_id', 'status', 'method', 'merchant', 'tgl_kirim', 'no_resi', 'biaya'
    ];

    public function variasi()
    {
        return $this->belongsTo('App\Models\ProdukVariasi', 'variasi_id');
    }
}
