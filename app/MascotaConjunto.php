<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MascotaConjunto extends Model
{
    protected $table = 'mascotas_conjuntos';
    protected $fillable = ['mascota_id', 'conjunto_id'];
}
