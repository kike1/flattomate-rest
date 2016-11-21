<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table='services';
 
    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = array('name');
 
    // Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
    protected $hidden = ['created_at','updated_at'];

    public function accommodations()
    {
        return $this->belongsToMany('App\Accommodation');
    }
}
