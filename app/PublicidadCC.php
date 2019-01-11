<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicidadCC extends model {

    protected $table = 'publicidad_cc';
    protected $fillable = ['publicidad_id', 'centrocomercial_id', 'fecha'];
}