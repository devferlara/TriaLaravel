<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioPublicidad extends Model
{
    protected $table = 'usuario_publicidad';
    protected $fillable = ['usuario_id', 'publicidad_id', 'leido', 'fecha_leido'];
}