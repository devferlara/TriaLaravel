<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicidadSegmentos extends model {

    protected $table = 'segmentos_conjuntos';
    protected $fillable = ['publicidad_id', 'localidad','ciudad','pais'];
}