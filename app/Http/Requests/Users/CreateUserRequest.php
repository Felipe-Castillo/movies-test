<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\CheckAttributesInDeleteRecordsRule;

class CreateUserRequest extends FormRequest
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
            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'email' => [
                "required",
                "email",
                new CheckAttributesInDeleteRecordsRule('users'),
                "unique:users",
            ],
            'password' => 'required|confirmed|min:6',
            'profile_pic' => 'nullable|image|max:5200|mimes:jpeg,jpg,png',
            'roles' => 'required|array',
            'roles.*' => 'required|exists:roles,id',
            'departments' => 'required|array',
            'departments.*' => 'required|exists:departments,id',
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => 'Nombres',
            'last_name' => 'Apellidos',
            'email' => 'Email',
            'password' => 'Contraseña',
            'profile_pic' => 'Imagen de perfil',
            'roles' => 'Roles',
            'roles.*' => 'Rol',
            'departments' => 'Departamentos',
            'departments.*' => 'Departamento',
        ];

    }
}
