<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class PagosPublicidad extends Model
{
	use SoftDeletes;
    //
    protected $table = 'pagos_publicidad';
    
    protected $fillable = [
	    'usuario_id',
	    'publicidad_tipo', 
	    'reference', 
	    'total', 
	    'estado_transaccion',
	    'mensaje',
	    'transaction_id',
	    'payment_method',
	    'buyer_email',
	    'payment_status',
	    'utilizado',
	    'status'
    ];
}
