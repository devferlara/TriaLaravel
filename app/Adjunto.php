<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adjunto extends model {

    protected $table = 'adjuntos';
    protected $fillable = ['nombre', 'ruta', 'tipo', 'peso', 'fecha'];

    // Many to many relationship Adjunto-Mensaje Table
    public function mensajes(){
        return $this->belongsToMany('App\Mensaje','adjunto_mensajes','adjunto_id','mensaje_id');
    }
}