<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accommodation_Service extends Model
{
    protected $table='accommodations_services';
    protected $fillable = array('id_accommodation','id_service');
}
