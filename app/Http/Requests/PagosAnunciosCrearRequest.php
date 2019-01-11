<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;


class PagosAnunciosCrearRequest extends Request
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
            'usuario_id'        => 'required',
            'reference'         => 'required',
            'total'             => 'required',
        ];
    }

    public function messages()
    {
        return [
            'administrador_id.required'     => 'Debe elegir un pautante.',
            'reference.required'            => 'Debe agreagar un número de referencia para el pago.',
            'total.required'                => 'Debe añadir un total del pago.',
        ];
    }
}