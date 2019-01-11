<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ManualFacturaRequest extends Request
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
            'fecha_corte'               => 'required',
            'nombre_propietaria'        => 'required',
            'valor_adeudado'            => 'required',
            'matricula_inmobiliaria'    => 'required',
            'coeficiente_inmueble'      => 'required',
            'concepto_pago'             => 'required',
            'saldo_mes_anterior'        => 'required',
            'saldo_anterior'            => 'required',
            'nuevo_saldo'               => 'required',
            'total_mes'                 => 'required',
            'id_csv'                    => 'required'

        ];
    }

    public function messages()
    {
    return [
        'archivo.required'  => 'Debes cargar un archivo, de lo contrario no podrás guardar ningún registro',
        'archivo.mimes'     => 'Solo se permiten archivos .csv',
    ];
    }
}