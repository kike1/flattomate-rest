<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table='announcements';
 
    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = array('title','description','availability', 'rent_kind','min_stay', 'max_stay', 'price', 'is_visible', 'is_shared_room', 'id_accommodation', 'id_user');
 
    // Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
    protected $hidden = ['created_at','updated_at'];

    public function accommodation()
    {
        return $this->hasOne('App\Accommodation', 'id', 'id_accommodation');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function images()
    {
        return $this->hasMany('App\Image', 'id_announcement');
    }
}
