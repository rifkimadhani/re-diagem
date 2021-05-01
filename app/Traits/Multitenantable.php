<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Multitenantable {

    protected static function bootMultitenantable()
    {
        if(auth()->guard('mitra')->check()) {
            static::creating(function ($model) {
                $model->mitra_id = auth()->guard('mitra')->id();
            });

            if (auth()->guard('mitra')->check()) {
                static::addGlobalScope('mitra_id', function (Builder $builder) {
                    $builder->where('mitra_id', auth()->guard('mitra')->id());
                });
            }
        }
    }
}
