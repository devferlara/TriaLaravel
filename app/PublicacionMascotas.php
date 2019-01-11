<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PublicacionMascotas extends model {

    protected $table = 'publimascotas';
    protected $fillable = [
     	'categoria',
        'titulo',
        'descripcion_corta',
        'descripcion',
     	'img_banner',
        'emisor', 
     	'valor', 
     	'fecha_desde', 
     	'fecha_hasta',
     	'link',
     	'enabled'];

     public function conjuntos(){
        return $this->belongsToMany('App\Conjunto','publicidad_mascotas', 'publimascota_id', 'conjunto_id');
    }

    public function setImgbannerAttribute($img_banner){
        if (!empty($img_banner)) {
        $this->attributes['img_banner']= carbon::now()->minute.$img_banner->getClientOriginalName();
        $nombrefile=carbon::now()->minute.$img_banner->getClientOriginalName();
        \Storage::disk('publimascotas')->put($nombrefile,\File::get($img_banner));
        }
    }
}
