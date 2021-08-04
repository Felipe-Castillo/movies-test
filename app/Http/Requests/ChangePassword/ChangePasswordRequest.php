<?php

namespace App\Http\Requests\ChangePassword;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ChangePassword\CheckIfAccessTokenIsValidRule;

class ChangePasswordRequest extends FormRequest
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
            'resetToken' => [
                'required',
                new CheckIfAccessTokenIsValidRule($this->email)
            ],
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'email',
            'password' => 'contraseña'
        ];
    }

    public function messages()
    {
        return [
            'email.exists' => 'El email proporcionado no existe en el sistema',
            'resetToken.required' => 'No hay token de acceso para realizar accion de cambio de contraseña, recargue el sitio o intente el proceso desde el inicio nuevamente'
        ];
    }
}
