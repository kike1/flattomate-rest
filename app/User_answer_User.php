<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_answer_User extends Model
{
    protected $table='users_answer_users';
    
    protected $fillable = [
        'id_user_sender', 'id_user_received', 'id_announcement'
    ];
}
