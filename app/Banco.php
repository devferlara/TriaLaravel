<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $table = 'bancos';
    protected $fillable = ['nombre', 'pais', 'link', 'enabled', 'img_banco'];

    public function setImagenBancoAttribute($img_banco){
        if (!empty($img_banco)) {
        $this->attributes['img_banco']= $img_banco->getClientOriginalName();
        $nombrefile= $img_bamcp->getClientOriginalName();
        \Storage::disk('bancos')->put($nombrefile,\File::get($img_banco));
        }
    }
}
