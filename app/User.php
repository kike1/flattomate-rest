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
 
    // Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
    
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'activity', 'bio', 'member_since'
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
