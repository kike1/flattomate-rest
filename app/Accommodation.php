<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    // Nombre de la tabla en MySQL.
    protected $table='accommodations';
 
    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = array('n_people','n_rooms','n_bathrooms','n_beds','location');
 
    // Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
    protected $hidden = ['created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function services()
    {
        return $this->belongsToMany('App\Service', 'accommodations_services', 'id_accommodation', 'id_service');
    }

    public function announcement()
    {
        return $this->hasOne('App\Announcement');
    }
    
}
