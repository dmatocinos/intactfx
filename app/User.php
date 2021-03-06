<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'intact_users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'password_text', 'facebook_id', 'avatar', 'affiliate_id', 'last_timestamp', 'new_timestamp'
    ];

    protected $dates = [ 'last_timestamp', 'new_timestamp' ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 
    ];

    public function social()
    {

        return $this->hasMany('App\Social');

    }

    public static function boot()
    {

        parent::boot();
        static::creating(function($user){
            $user->token = str_random(30);
        });
        
    }

    public function account()
    {
        
        return $this->hasOne('App\Account');

    }

     public function profile()
    {
        
        return $this->hasOne('App\Profile');

    }

}
