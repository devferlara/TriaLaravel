<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MensajeCrearRequest extends Request
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
            'asunto'=> 'required',
            'enviar_a'=> 'required',
            'mensaje'=> 'required',
            'importancia'=> 'required',
            'adjuntos[]'=>'mimes:pdf,jpeg,gif,jpg,png,xls,xlsx,doc,docx,ppt,pptx,|max:20000',
        ];
    }
}