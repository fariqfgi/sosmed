<?php

namespace App;
use App\Postingan;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Overtrue\LaravelFollow\Followable;

class User extends Authenticatable
{
    use Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
    * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function komentar()
    {
        return $this->hasMany('App\Komentar');
    }

    
    public function postingan ()
    {
        return $this->belongsToMany('App\Postingan', 'postingan_likes');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    
}
