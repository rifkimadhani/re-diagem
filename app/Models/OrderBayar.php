<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class OrderBayar extends Model
{
    protected $table = 'order_bayar';

    protected $fillable = [
        'order_id', 'method', 'layanan', 'virtual_account', 'jumlah', 'tgl_bayar', 'status'
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
}
