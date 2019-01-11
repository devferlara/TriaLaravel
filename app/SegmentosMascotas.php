<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SegmentosMascotas extends model {

    protected $table = 'segmentos_mascotas';
    protected $fillable = ['publimascota_id', 'localidad','ciudad','pais'];
}