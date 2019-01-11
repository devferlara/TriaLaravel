<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class PagoConjunto extends Model
{
	use SoftDeletes;
    //
    protected $table = 'pagos_conjuntos';
    
    protected $fillable = [
	    'administrador_id',
	    'conjunto_id', 
	    'reference', 
	    'total', 
	    'estado_transaccion',
	    'mensaje',
	    'transaction_id',
	    'payment_method',
	    'buyer_email',
	    'payment_status',
	    'fecha_inicio',
	    'fecha_fin',
	    'status'
    ];
}
