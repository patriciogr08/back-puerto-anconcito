<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginAuth extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'usuario'  => 'required|string',
            'password' => "required|string",
        ];
    }

    public function messages() {

        return [
            'usuario.required'  => 'Debe ingresar el usuario.',
            'usuario.string'    => 'Debe ingresar un usuario válido.',
            'password.required' => 'Debe ingresar su contraseña.',
        ];
    }
}
