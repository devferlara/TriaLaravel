<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BancoUpdateRequest extends Request
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
            'nombre'=> 'required',
            'pais'=> 'required',
            'link'=> 'required',
            'img_banco'=>'mimes:jpeg,jpg,png,JPG,PNG,JPEG|max:8000',
        ];
    }
}
