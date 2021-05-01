<?php

namespace App\Models;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Kalnoy\Nestedset\NodeTrait;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Kategori extends Model
{
    use HasSlug;
    use NodeTrait;
    use QueryCacheable;

    // Cache Duration
    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;


    protected $table = 'kategori';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama', 'slug', 'parent_id', 'icon', 'cover',
    ];
    // protected $appends = [
    //     'image_url',
    // ];

    public function sub_kategori(){

        return $this->hasMany('App\Models\Kategori', 'parent_id');

    }

    public function parent(){
        return $this->belongsTo('App\Models\Kategori', 'parent_id');
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nama')
            ->saveSlugsTo('slug');
    }

    public function getThumbnailAttribute($value)
    {
        if(!empty($value))
        {
            return 'public/uploads/'.$value;
        }
    }

    public function getImageUrlAttribute($value)
    {
        return asset('uploads/'.$this->attributes['thumbnail']);
    }

    public function getCreatedAtAttribute($value)
	{
		return Carbon::parse($value)->format('d-m-Y');
    }

}
