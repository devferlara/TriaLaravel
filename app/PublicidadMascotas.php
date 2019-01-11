<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicidadMascotas extends model {

    protected $table = 'publicidad_mascotas';
    protected $fillable = ['publimascota_id', 'conjunto_id', 'fecha'];
}	
