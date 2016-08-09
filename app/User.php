<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    protected $table='users';

    protected $fillable = [
        'name', 'email', 'password', 'birthday', 'languages', 'avatar', 'activity', 'sex', 'smoke', 'sociable', 'tidy', 'bio'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    /* relationships */
    public function accommodations()
    {
        return $this->belongsToMany('App\Accommodation');
    }

    public function languages()
    {
        return $this->belongsToMany('App\Language');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function announcements()
    {
        return $this->belongsToMany('App\Announcement');
    }
}
