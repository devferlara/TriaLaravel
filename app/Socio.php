<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{

    protected $table = "socios";

    protected $fillable = [
      'usuario_id',
      'franquiciado',
      'cuotas'
    ];

    public function usuario() {

      return $this->belongsTo('App\User');
    }
}
