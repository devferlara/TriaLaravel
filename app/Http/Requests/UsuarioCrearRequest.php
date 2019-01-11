<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsuarioCrearRequest extends Request
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
        'rol'=> 'required',
        'conjunto'=> 'required',
        'username'=> 'required|unique:usuarios',
        'password'=> 'required',
        ];
    }

    public function messages()
    {
    return [
        'zona.required' => 'Para continuar con la creación del usuario debes crear una zona o seleccionar una existente',
        'apartamento.required' => 'Para continuar con la creación del usuario debes asignar un apartamento',
        'conjunto.required' => 'Crea primero un conjunto, una zona y asigna un apartamento para guardar el usuario correctamente',
    ];
    }
}