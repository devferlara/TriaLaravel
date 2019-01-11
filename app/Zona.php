<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Zona extends Model
{   
    protected $table = 'zonas';
    protected $fillable = ['tipo', 'zona', 'descripcion', 'conjunto_id'];

    //funcion para hacer select dinamicos y listar zonas de un conjunto

    public function apartamentos(){
        return $this->hasMany('App\Apartamento');
    }

    public function conjuntos(){
        return $this->belongsTo('App\Conjunto', 'conjunto_id');
    }

    public function listarZonasdeConjunto($conjunto){
        $zonas = Zona::where('conjunto_id','=',$conjunto)->orderBy('ID', 'DESC')->get();
        return $zonas;
    }

    public function contarUsuariosZona($zonaId){

        $query = DB::table('usuarios as usuario')
            ->join('usuario_apartamentos as u_a', 'usuario.id', '=', 'u_a.usuario_id')
            ->join('apartamentos as apartamento', 'u_a.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->select('usuario.id as id')
            ->where('zona.id', '=',$zonaId)
            ->count();

        return $query;
    }

    public static function zonas($id){
        return Zona::where('conjunto_id','=',$id)
        ->get();
    }

    public function zonasConjunto($conjuntoId)
    {
        $query = DB::table('zonas as zona')
            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
            ->select('zona.id')
            ->where('conjunto.id', '=', $conjuntoId)
            ->count();
        return $query;
    }
}