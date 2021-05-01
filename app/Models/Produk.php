<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Produk extends Model
{
    use Uuid;
    use HasSlug;
    use QueryCacheable;

    // Cache Duration
    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;


    protected $table = 'produk';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nama', 'slug', 'kategori_id', 'has_variasi', 'var1_nama', 'var2_nama', 'var1_value', 'var2_value', 'harga',
        'berat', 'berat_satuan', 'material', 'kode', 'ukuran', 'kadar', 'jenis_permata', 'berat_permata'
    ];

    protected $appends = [
        'fotoUtama', 'harga', 'harga_format', 'stok'
    ];

    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori', 'kategori_id');
    }

    public function produk_variasi()
    {
        return $this->hasMany('App\Models\ProdukVariasi', 'produk_id');
    }

    public function getHargaAttribute($value)
    {
        if($this->produk_variasi()->count() > 1)
        {
            // return $this->produk_variasi
            if($this->produk_variasi->min('harga') === $this->produk_variasi->max('harga'))
            {
                return "Rp" .number_format($this->produk_variasi->max('harga'),0,',','.');
            }else{
                return "Rp" .number_format($this->produk_variasi->min('harga'),0,',','.').' - '."Rp" .number_format($this->produk_variasi->max('harga'),0,',','.');
            }
        }else{
            return "Rp" .number_format($this->produk_variasi[0]['harga'],0,',','.');
        }
    }

    public function getStokAttribute($value)
    {
        return $this->produk_variasi->sum('stok');
    }

    public function getHargaFormatAttribute($value)
    {
        if($this->produk_variasi()->count() > 1)
        {
            // return $this->produk_variasi
            if($this->produk_variasi->min('harga') === $this->produk_variasi->max('harga'))
            {
                return number_format($this->produk_variasi->max('harga'),0,'','');
            }else{
                return number_format($this->produk_variasi->min('harga'),0,',','').' - '.number_format($this->produk_variasi->max('harga'),0,'','');
            }
        }else{
            return number_format($this->produk_variasi[0]['harga'],0,'','');
        }
    }

    public function foto() {
        return $this->hasMany('App\Models\ProdukFoto', 'produk_id', 'id');
    }

    public function getFotoUtamaAttribute() {
        $get = $this->hasMany('App\Models\ProdukFoto', 'produk_id', 'id')->where('is_utama', 1)->first();
        if($get)
        {
            return asset('public/uploads/'.$get->path);
        }else{
            return null;
        }
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nama')
            ->saveSlugsTo('slug');
    }
    

}
