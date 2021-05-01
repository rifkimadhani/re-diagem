<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class ProdukFoto extends Model
{
    use Uuid;

    protected $table = 'produk_foto';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'produk_id', 'path', 'is_utama'
    ];

    protected $appends = [
        'image_url',
    ];

    public function produk()
    {
        return $this->belongsTo('App\Models\Produk', 'produk_id');
    }

    public function getImageUrlAttribute($value)
    {
            return asset('uploads/'.$this->attributes['path']);
    }

}
