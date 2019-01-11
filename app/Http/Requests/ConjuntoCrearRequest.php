<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ConjuntoCrearRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nit'=> 'required',
            'nombre'=> 'required',
            'tipo'=> 'required',
            'pais'=> 'required',
            'ciudad'=> 'required',
            'localidad'=> 'required',
            'barrio'=> 'required',
            'direccion'=> 'required',
            'telefono'=> 'required',
            'estrato'=> 'required',
            'map_latitud'=> 'required',
            'map_longitud'=> 'required',
            'telefono_cuadrante'=> 'required',
            'horario_administracion'=> 'required',
        ];
    }
}
