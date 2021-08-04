<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckAttributesInDeleteRecordsRule;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|string|max:35',
            'last_name' => 'required|string|max:35',
            'email' => [
                "required",
                "email",
                "max:50",
                new CheckAttributesInDeleteRecordsRule('users'),
                "unique:users",
            ],
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function attributes()
    {
        return [
            'access_card_id' => 'Tarjeta de acceso'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'El nombre es requerido',
            'first_name.max' => 'El nombre no puede ser de mas de 35 caracteres',
            'last_name.required' => 'El apellido es requerido',
            'last_name.max' => 'El apellido no puede ser de mas de 35 caracteres',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email es no es una direccion de correo vailda',
            'email.max' => 'El email no puede ser de mas de 50 caracteres',
            'email.unique' => 'El email ya esta en uso por otro usuario',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña es debe tener 6 caracteres como minimo',
            'password.confirmed' => 'La confirmacion de contraseña no coincide',
        ];
    }
}
