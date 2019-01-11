<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PubliComerciales extends model {

    protected $table = 'publicacion_comerciales';
    protected $fillable = ['publicacion_id', 'centrocomercial_id', 'fecha'];
}