<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Accommodation extends Model
{
    protected $table='users_accommodations';
    
    protected $fillable = [
        'id_user', 'id_accommodation'
    ];
}
