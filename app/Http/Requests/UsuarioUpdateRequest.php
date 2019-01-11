<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class UsuarioUpdateRequest extends Request
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
        'nombres'=> 'required',
        'apellidos'=> 'required',
        'rol'=> 'required',
        'genero'=> 'required',
        'identificacion'=> 'required',
        'email'=> 'required|email|max:255|unique:usuarios,id,'.Auth::user()->id,
        //'conjunto'=> 'required',
        'fecha_nacimiento'=> 'required',
        'telefono'=> 'required',
        'celular'=> 'required',
        'username'=> 'required',
        ];
    }
}