<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Carbon\Carbon;
class Promo extends Model
{
    use HasSlug;
    use Uuid;

    protected $table = 'promo';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'judul', 'slug', 'deskripsi', 'image', 'is_active', 'is_featured', 'tgl_mulai', 'tgl_selesai',
    ];

    protected $appends = [
        'periode','status', 'featured',
    ];

    public function getPeriodeAttribute($value)
    {
        Carbon::setLocale('id');
        if(empty($this->attributes['tgl_mulai']) && empty($this->attributes['tgl_selesai']))
        {
            return '--';
        }else{
            return Carbon::parse($this->attributes['tgl_mulai'])->translatedFormat('d F').' - '.Carbon::parse($this->attributes['tgl_selesai'])->translatedFormat('d F Y');
        }
    }

    public function getStatusAttribute($value)
    {
        if($this->attributes['is_active'] === 1)
        {
            return '<span class="badge badge-success">Aktif</span>';
        }else{
            return '<span class="badge badge-danger">Tidak Aktif</span>';
        }
    }

    public function getFeaturedAttribute($value)
    {
        if($this->attributes['is_featured'] === 1)
        {
            return '<span class="badge badge-primary">Featured</span>';
        }
    }

    public function getImageAttribute($value)
    {
        return asset('uploads/'.$this->attributes['image']);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('judul')
            ->saveSlugsTo('slug');
    }
}
