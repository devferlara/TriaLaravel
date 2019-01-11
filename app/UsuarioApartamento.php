<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioApartamento extends Model
{
    protected $table = 'usuario_apartamentos';
    protected $fillable = ['usuario_id', 'apartamento_id', 'propietario'];
   
}