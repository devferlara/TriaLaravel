<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Apartamento extends Model
{
    protected $table = 'apartamentos';
    protected $fillable = ['apartamento', 'descripcion', 'zona_id'];

    // Many to many relationship Usuario-Apartamento Table
    public function usuarios(){
        return $this->belongsToMany('App\User','usuario_apartamentos','apartamento_id','usuario_id');
    }

    public function zonas(){
        return $this->belongsTo('App\Zona', 'zona_id');
    }
    
    public static function contarApartamentosConjunto($conjunto){

        $query = DB::table('apartamentos as apartamento')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
            ->select('apartamento.id','apartamento.apartamento','zona.zona as zona')
            ->where('conjunto.id', '=', $conjunto)
            ->count();

        return $query;
    }

    public static function listarApartamentosZona($zona){

        $query = DB::table('apartamentos as apartamento')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->select('apartamento.id','apartamento.apartamento','zona.zona as zona')
            ->where('zona.id', '=', $zona)
            ->get();

        return $query;
    }

    public static function apartamentos($id){
        return Apartamento::where('zona_id','=',$id)
        ->get();
    }

    public static function contarNoregistradosxConjunto($conjunto){

        $query = DB::table('usuarios as usuario')
            ->join('usuario_apartamentos as u_a', 'usuario.id', '=', 'u_a.usuario_id')
            ->join('apartamentos as apartamento', 'u_a.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
            ->select('usuario.id', 'usuario.nombres')
            ->where('usuario.nombres', '=', '')
            ->where('conjunto.id', '=', $conjunto)
            ->count();
        return $query;
    }
}