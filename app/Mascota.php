<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Mascota extends Model
{
    protected $table = 'mascotas';
    protected $fillable = ['usuario_id', 'nombre', 'raza', 'edad', 'tipo', 'genero', 'img_mascota', 'vacunas', 'registrado'];

    public function conjunto(){
        return $this->belongsToMany('App\Conjunto','mascotas_conjuntos','mascota_id', 'conjunto_id');
    }

    public function usuario(){
        return $this->belongsTo('App\User');
    }

    public function setImgmascotaAttribute($img_mascota){
        if (!empty($img_mascota)) {
        $this->attributes['img_mascota']= carbon::now()->second.$img_mascota->getClientOriginalName();
        $nombrefile=carbon::now()->second.$img_mascota->getClientOriginalName();
        \Storage::disk('mascotas')->put($nombrefile,\File::get($img_mascota));
        }
    }
}
