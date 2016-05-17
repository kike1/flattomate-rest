<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Language extends Model
{
    protected $table='userslanguages';
 
    // Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
    
    protected $fillable = [
        'id_user', 'id_language'
    ];
}
