<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class BancoConjunto extends Model
{
    protected $table = 'bancos_conjuntos';
    protected $fillable = ['banco_id','conjunto_id','tipo_cuenta','No_cuenta','No_convenio','habilitado'];
}
