<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table='announcements';
 
    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = array('title','description','availability','min_days','max_days', 'price', 'is_visible', 'is_shared_room', 'is_private_room');
 
    // Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
    protected $hidden = ['created_at','updated_at'];

    public function accommodations()
    {
        return $this->belongsTo('App\Accommodation');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function images()
    {
        return $this->belongsToMany('App\Image');
    }
}
