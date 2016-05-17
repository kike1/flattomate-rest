<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table='languages';
 
    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = array('name');
 
    // Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
    protected $hidden = ['created_at','updated_at'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
