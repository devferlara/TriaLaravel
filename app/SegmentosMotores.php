<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SegmentosMotores extends model {

    protected $table = 'segmentos_vehiculos';
    protected $fillable = ['publivehiculo_id', 'localidad','ciudad','pais'];
}