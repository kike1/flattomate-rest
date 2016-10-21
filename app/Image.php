<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table='images';
 
    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = array('path','main');
 
    // Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
    protected $hidden = ['created_at','updated_at'];

    /* relationships */
    public function announcement()
    {
        return $this->belongsTo('App\Announcement');
    }
}
