<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'nickname', 'remember_token',
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



    // Negocios de un usuario
    public function admins(){
        return $this->hasMany('App\StoreAdmin');
    }

    // Preferencias
    public function preferences(){
        return $this->hasMany('App\UserPreference');
    }

    // Direcciones
    public function addresses(){
        return $this->hasMany('App\UserAddress');
    }

    // Items favoritos
    public function likes(){
        return $this->hasMany('App\UserLike');
    }

    // Mensajes
    public function messages(){
        return $this->hasMany('App\Message');
    }

    // El perfil
    public function profile(){
        return $this->hasOne('App\UserProfile');
    }

    // Recover
    public function recover(){
        return $this->hasOne('App\UserRecover');
    }


}
