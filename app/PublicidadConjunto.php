<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicidadConjunto extends model {

    protected $table = 'publicidad_conjuntos';
    protected $fillable = ['conjunto_id', 'publicidad_id'];
}