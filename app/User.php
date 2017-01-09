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
        'name', 'email', 'password', 'birthdate', /*'city', 'country',*/ 'languages', 'activity', 'sex', 'smoke', 'sociable', 'tidy', 'bio'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    /* relationships */
    public function accommodations()
    {
        return $this->hasMany('App\Accommodation');
    }

    public function languages() //many to many
    {
        return $this->belongsToMany('App\Language', 'users_languages', 'id_user', 'id_language');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function announcements()
    {
        return $this->hasMany('App\Announcement');
    }

    public function chats()
    {
        return $this->belongsToMany('App\User', 'users_answer_users', 'id_user_sender', 'id_user_receiver')->withPivot('id_announcement');
    }
}
