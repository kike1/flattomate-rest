<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Language extends Model
{
    protected $table='userslanguages';
    
    protected $fillable = [
        'id_user', 'id_language'
    ];
}
