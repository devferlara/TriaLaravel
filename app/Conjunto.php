<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\ConjuntoCrearRequest;
use App\Http\Requests\ConjuntoUpdateRequest;
use DB;
use Carbon\Carbon;

class Conjunto extends Model
{
   	protected $table = 'conjuntos';

    protected $fillable = [
        'nit', 
        'nombre', 
        'tipo', 
        'pais', 
        'ciudad', 
        'localidad', 
        'barrio', 
        'direccion', 
        'telefono', 
        'estrato', 
        'map_latitud', 
        'map_longitud', 
        'telefono_cuadrante', 
        'horario_administracion', 
        'img_perfil', 
        'banner_conjunto'];


    public function zonas(){
        return $this->hasMany('App\Zona');
    }

    public function noticia(){
        return $this->hasMany('App\Noticia');
    }

    // Many to many relationship Administrador-Conjunto Table
    public function administrador(){
        return $this->belongsToMany('App\Administrador','administrador_conjuntos','conjunto_id','administrador_id');
    }

    // Many to many relationship Administrador-Conjunto Table
    public function publicidad()
    {
        return $this->belongsToMany('App\Publicidad','publicidad_conjuntos','conjunto_id','publicidad_id');
    }
    // Relacion club mascotas //
    public function mascota()
    {
        return $this->belongsToMany('App\Mascota','mascotas_conjuntos','conjunto_id','mascota_id');
    }
    //relacion de vehiculos club motor
    public function vehiculo()
    {
        return $this->belongsToMany('App\Vehiculo','vehiculos_conjuntos', 'conjunto_id', 'vehiculo_id');
    }
    //relacion con publicidad mascotas
    public function publimascotas(){
        return $this->belongsToMany('App\PublicacionMascotas','publicidad_mascotas', 'conjunto_id', 'publimascota_id');
    }

    public function publivehiculos(){
        return $this->belongsToMany('App\PublicacionVehiculos','publicidad_vehiculos', 'conjunto_id', 'publivehiculo_id');
    }

    public function listarConjuntosSinAdministrador(){

       $query = Conjunto::whereNotExists(function($query)
        {
            $query->select(DB::raw(1))
                ->from('administrador_conjunto')
                ->whereRaw('conjuntos.id = administrador_conjunto.conjunto_id');
        })->get();


        return $query;
    }

    public function contarUsuariosConjunto($conjuntoId){

        $query = DB::table('usuarios as usuario')
            ->join('usuario_apartamentos as u_a', 'usuario.id', '=', 'u_a.usuario_id')
            ->join('apartamentos as apartamento', 'u_a.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
            ->select('usuario.id as id')
            ->where('conjunto.id', '=',$conjuntoId)
            ->count();

        return $query;
    }

    public function contarNoRegistradosConjunto($conjuntoId){

        $query = DB::table('usuarios as usuario')
            ->join('usuario_apartamentos as u_a', 'usuario.id', '=', 'u_a.usuario_id')
            ->join('apartamentos as apartamento', 'u_a.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
            ->select('usuario.id', 'usuario.nombres')
            ->where('usuario.nombres', '=', '')
            ->where('conjunto.id', '=',$conjuntoId)
            ->count();
        return $query;
    }

    public function scopeNombreconjunto($query, $nomconjunto)
    {
        if (trim($nomconjunto) != "")
        {   
            $query->where(\DB::raw ("nombre"), "LIKE", "%$nomconjunto%");
        }
    }
    
    public function setBannerconjuntoAttribute($banner_conjunto){
        if (!empty($banner_conjunto)) {
        $this->attributes['banner_conjunto']= carbon::now()->second.$banner_conjunto->getClientOriginalName();
        $nombrefile=carbon::now()->second.$banner_conjunto->getClientOriginalName();
        \Storage::disk('banners')->put($nombrefile,\File::get($banner_conjunto));
        }
    }

    public function setImgperfilAttribute($img_perfil){
        if (!empty($img_perfil)) {
        $this->attributes['img_perfil']= carbon::now()->second.$img_perfil->getClientOriginalName();
        $nombrefile=carbon::now()->second.$img_perfil->getClientOriginalName();
        \Storage::disk('banners')->put($nombrefile,\File::get($img_perfil));
        }
    }
}