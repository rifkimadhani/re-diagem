<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'produk_id', 'variasi_id', 'qty', 'harga', 'bisnis_id'
    ];


    protected $appends = ['produk_nama','harga_frm', 'subTotal_frm', 'sub_total'];


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
