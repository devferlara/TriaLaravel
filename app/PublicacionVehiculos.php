<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PublicacionVehiculos extends model {

    protected $table = 'publivehiculos';
    protected $fillable = [
     	'categoria',
        'titulo',
        'descripcion_corta',
        'descripcion',
     	'img_publicacion',
     	'img_banner', 
     	'valor', 
     	'fecha_desde', 
     	'fecha_hasta',
     	'link',
     	'enabled'];

    public function conjuntos(){
        return $this->belongsToMany('App\Conjunto','publicidad_vehiculos', 'publivehiculo_id', 'conjunto_id');
    }
    public function setImgbannerAttribute($img_banner){
        if (!empty($img_banner)) {
        $this->attributes['img_banner']= carbon::now()->minute.$img_banner->getClientOriginalName();
        $nombrefile=carbon::now()->minute.$img_banner->getClientOriginalName();
        \Storage::disk('publivehiculos')->put($nombrefile,\File::get($img_banner));
        }
    }
}
