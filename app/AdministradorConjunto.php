<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdministradorConjunto extends Model
{
    protected $table = 'administrador_conjuntos';
    protected $fillable = ['administrador_id' , 'conjunto_id'];



}
