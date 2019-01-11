<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PublivehiculosCrearRequest extends Request
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
            'emisor'=> 'required',
            'categoria'=> 'required',
            'envio'=> 'required',
            'img_banner'=>'mimes:jpeg,jpg,png,JPG,PNG,JPEG,pdf,PDF|max:8000',
        ];
    }
}