<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\CheckAttributesInDeleteRecordsRule;

class UpdateUserRequest extends FormRequest
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
                Rule::unique('users')->ignore($this->user)
            ],
            'password' => 'nullable|confirmed|min:6',
            'profile_pic' => 'nullable|image|max:5120|mimes:jpeg,jpg,png',
            'roles' => 'nullable|array',
            'roles.*' => 'nullable|exists:roles,id',
            'departments' => 'nullable|array',
            'departments.*' => 'nullable|exists:departments,id',
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
