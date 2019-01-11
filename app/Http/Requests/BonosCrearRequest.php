<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BonosCrearRequest extends Request
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
            'titulo'=> 'required',
            'descripcion'=> 'required',
            'valor'=> 'required',
            'tienda'=> 'required',
            'local'=> 'required',
            'categoria'=> 'required',
            'envio'=> 'required',
            'img_publicidad'=>'mimes:jpeg,jpg,png,JPG,PNG,JPEG,pdf,PDF|max:8000',
            'logo'=>'mimes:jpeg,jpg,png,JPG,PNG,JPEG|max:8000',
        ];
    }
}