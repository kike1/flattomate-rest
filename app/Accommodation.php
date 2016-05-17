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

    // Relación de Fabricante con Aviones:
    public function aviones()
    {   
        // 1 fabricante tiene muchos aviones
        // $this hace referencia al objeto que tengamos en ese momento de Fabricante.
        return $this->hasMany('App\Avion');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function services()
    {
        return $this->belongsToMany('App\Service');
    }

    public function announcements()
    {
        return $this->belongsTo('App\Announcement');
    }
    
}
