<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuraciones';
    protected $fillable = ['usuarios_id', 'email_notificaciones', 'img_perfil', 'img_banner', 'notificaciones'];

    public function usuario(){
        return $this->belongsTo('User');
    }
}
