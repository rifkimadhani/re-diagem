<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use App\Notifications\AdminEmailVerificationNotification;
// use App\Notifications\AdminResetPasswordNotification as Notification;

class Mitra extends Authenticatable
{
    // use Notifiable;
//
    protected $table = 'mitra';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'username', 'kontak', 'email', 'password', 'alamat'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function toko()
    {
        return $this->hasOne('App\Models\Toko', 'mitra_id', 'id');
    }

    public function daerah()
    {
        return $this->belongsTo('App\Models\Daerah', 'daerah_id', 'id');
    }

    // /**
    //  * Custom password reset notification.
    //  *
    //  * @return void
    //  */
    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new Notification($token));
    // }

    // /**
    //  * Send email verification notice.
    //  *
    //  * @return void
    //  */
    // public function sendEmailVerificationNotification()
    // {
    //     $this->notify(new AdminEmailVerificationNotification);
    // }
}
