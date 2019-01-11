<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FacturaCargarRequest extends Request
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
            'conjunto'=> 'required',
            'archivo'=> 'required',
        ];
    }

    public function messages()
    {
    return [
        'archivo.required' => 'Debes cargar un archivo, de lo contrario no podrás guardar ningún registro',
    ];
    }
}
