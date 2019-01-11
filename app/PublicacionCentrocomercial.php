<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicacionCentrocomercial extends model {

    protected $table = 'publi_comerciales';
    protected $fillable = [
     	'nombre', 
     	'descripcion_corta', 
     	'descripcion',
     	'categoria',
     	'img_publicacion',
     	'banner_publicacion', 
     	'fecha', 
     	'fecha_desde', 
     	'fecha_hasta',
     	'link',
     	'enabled'];

    // Many to many relationship Centro comercial - Publicacion Table
    public function centroscomerciales(){
        return $this->belongsToMany('CentroComercial','publicacion_comerciales','publicacion_id','centrocomercial_id');
    }
}
