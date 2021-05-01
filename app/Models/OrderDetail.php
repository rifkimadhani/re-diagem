<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class OrderDetail extends Model
{
    use Uuid;

    protected $table = 'order_detail';

    protected $fillable = [
        'order_id', 'produk_id', 'variasi_id', 'quantity', 'harga', 'sub_total', 'coupon_id'
    ];

    protected $appends = ['produk_nama','harga_frm', 'subTotal_frm', 'sub_total'];

    public function bisnis()
    {
        return $this->belongsTo('App\Models\Bisnis', 'bisnis_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function produk()
    {
        return $this->belongsTo('App\Models\Produk', 'produk_id');
    }

    public function variasi()
    {
        return $this->belongsTo('App\Models\ProdukVariasi', 'variasi_id', 'id');
    }

    public function getHargaFrmAttribute($value)
    {
        return "Rp" .number_format($this->attributes['harga'],0,',','.');
    }

    public function getSubTotalFrmAttribute($value)
    {
        return "Rp" .number_format($this->attributes['harga']*$this->attributes['qty'],0,',','.');
    }

    public function getSubTotalAttribute($value)
    {
        return number_format($this->attributes['harga']*$this->attributes['qty'],0,'','');
    }

    public function getProdukNamaAttribute($value)
    {
        if($this->variasi->variant === null)
        {
            return $this->produk->nama;
        }else{
            return $this->produk->nama .' ('. $this->variasi->variant.')';
        }
    }
}
