<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    protected $table = 'factura_apartamentos';
    protected $fillable = [];

    public static function obtenerRecibosConjunto($conjunto){

        $query = DB::table('factura_apartamentos as recibo')
            ->join('apartamentos as apartamento', 'recibo.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
            ->select('recibo.*')
            ->where('conjunto.id', '=', $conjunto)
            ->paginate(20);
        return $query;
    }
}
