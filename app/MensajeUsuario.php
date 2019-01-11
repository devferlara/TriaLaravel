<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class MensajeUsuario extends model {

    protected $table = 'mensaje_usuarios';
    protected $fillable = ['from_id', 'to_id', 'mensaje_id', 'leido', 'fecha_leido'];

}