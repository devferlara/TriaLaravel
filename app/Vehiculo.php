<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';
    protected $fillable = ['usuario_id','tipo', 'placa', 'cantidad', 'modelo', 'color', 'marca', 'parqueadero', 'tipo_parqueadero', 'registrado'];

    public function conjunto()
    {
        return $this->belongsToMany('App\Conjunto','vehiculos_conjuntos', 'vehiculo_id', 'conjunto_id');
    }

    public function usuario(){
        return $this->belongsTo('App\User');
    }

    public function publicacionvehiculo()
    {
        return $this->belongsToMany('App\PublicacionVehiculo','publicidad_vehiculos');
    }
}
