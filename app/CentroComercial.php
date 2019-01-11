<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CentroComercial extends model {

    protected $table = 'centros_comerciales';
    protected $fillable = [
        'nombre',
        'pais',
        'ciudad',
        'barrio',
        'direccion',
        'telefono',
        'descripcion',
        'img_perfil',
        'img_banner',
        'map_latitud',
        'map_longitud'
    ];

    // Many to many relationship Publicidad - Conjunto Table
    public function publicidades(){
        return $this->belongsToMany('Publicidad','publicidad_cc','centrocomercial_id','publicidad_id');
    }

    // Many to many relationship Centro comercial - Publicacion Table
    public function publicacioncc(){
        return $this->belongsToMany('PublicacionCentrocomercial','publicacion_comerciales','centrocomercial_id','publicacion_id');
    }

}