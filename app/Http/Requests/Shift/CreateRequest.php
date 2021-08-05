<?php

namespace App\Http\Requests\Shift;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'shift_hour'   => 'required',
            //'status'   => 'required',
       
        ];
    }


    public function attributes()
    {
        return [
            'shift_hour'     => 'Turno',
            //'status'   => 'Estado',

        ];
    }

}
