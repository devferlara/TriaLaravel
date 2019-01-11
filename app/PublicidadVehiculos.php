<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class PublicidadVehiculos extends model {

    protected $table = 'publicidad_vehiculos';
    protected $fillable = ['publivehiculo_id', 'conjunto_id', 'fecha'];
}