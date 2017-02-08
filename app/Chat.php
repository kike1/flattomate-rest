<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table='chats';

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = array('id_user_wrote','id_user_receive', 'id_announcement', 'message');

    // Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
    //protected $hidden = ['created_at','updated_at'];

    /* relationships */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
