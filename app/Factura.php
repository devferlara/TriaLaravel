<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    //
    protected $table = 'facturas_conjuntos';
    
    protected $fillable = [
	    'conjunto_id',
	    'fecha_corte', 
	    'nombre_propietaria', 
	    'valor_adeudado', 
	    'matricula_inmobiliaria',
	    'coeficiente_inmueble',
	    'concepto_pago',
	    'saldo_mes_anterior',
	    'saldo_anterior',
	    'nuevo_saldo',
	    'total_mes',
	    'correo_conjunto',
	    'estado'
    ];
}
