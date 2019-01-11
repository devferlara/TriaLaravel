<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AdjuntoMensaje extends model {

    protected $table = 'adjunto_mensajes';
    protected $fillable = ['adjunto_id', 'mensaje_id'];

}