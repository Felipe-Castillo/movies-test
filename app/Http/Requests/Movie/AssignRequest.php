<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;

class AssignRequest extends FormRequest
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
            'shift_ids'   => 'required',
            'movie_id'   => 'required',
       
        ];
    }


    public function attributes()
    {
        return [
            'shift_ids'     => 'Turnos',
            'movie_id'     => 'Pelicula'

        ];
    }

}
