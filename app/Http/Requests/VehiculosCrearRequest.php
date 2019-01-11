<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class VehiculosCrearRequest extends Request
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
            'tipo'=> 'required',
            'placa'=> 'required',
            'cantidad'=> 'required',
            'marca'=> 'required',
            'modelo'=> 'required',
            'color'=> 'required',
            'parqueadero'=> 'required',
            'registrado'=> 'required',
        ];
    }
}