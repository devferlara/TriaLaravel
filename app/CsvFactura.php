<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CsvFactura extends Model
{
    protected $table = 'csv_facturas_conjuntos';
    
    protected $fillable = [
	    'name',
	    'file_name', 
	    'administrador_id'
    ];
    
}
