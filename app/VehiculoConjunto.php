<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehiculosConjunto extends Model
{
    protected $table = 'vehiculos_conjuntos';
    protected $fillable = ['conjunto_id', 'vehiculo_id', 'fecha'];
}
