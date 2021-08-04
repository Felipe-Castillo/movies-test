<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name'   => 'required',
            'publication_date'   => 'required|date',
            'status'   => 'required',
            'cover'   => 'required',
       
        ];
    }


    public function attributes()
    {
        return [
            'name'     => 'Nombre',
            'publication_date'     => 'Fecha de Publicacion',
            'status'   => 'Estado',
            'cover'    => 'Imagen'
        ];
    }

}
