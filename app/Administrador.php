<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table = 'administradores';
    protected $fillable = ['rol', 'usuario_id'];

    public function usuarios(){
        return $this->belongsTo('App\User', 'usuario_id');
    }

    // Many to many relationship Administrador-Conjunto Table
    public function conjuntos(){

        return $this->belongsToMany('App\Conjunto','administrador_conjuntos','administrador_id','conjunto_id');

    }


}