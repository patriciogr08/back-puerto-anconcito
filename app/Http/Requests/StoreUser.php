<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'usuario'         => 'required|string|min:3|max:20',
            'primerNombre'    => 'required|string|min:3|max:20',
            'segundoNombre'   => 'required|string|min:3|max:20',
            'primerApellido'  => 'required|string|min:3|max:20',
            'segundoApellido' => 'required|string|min:3|max:20',
            'email'           => 'required|string|email|unique:users|min:6|max:50',
            'password'        => 'required|string|min:8|confirmed',
        ];
    }

    public function messages() {

        return [
            'usuario.required'         => 'El usuario es obligatorio.',
            'usuario.min'              => 'El usuario debe tener mínimo 3 caracteres.',
            'usuario.max'              => 'El usuario debe tener máximo 20 caracteres.',
            'usuario.string'           => 'El usuario debe ser string.',
            'primerNombre.required'    => 'El primer nombre es obligatorio.',
            'primerNombre.min'         => 'El primer nombre debe tener mínimo 3 caracteres.',
            'primerNombre.max'         => 'El primer nombre debe tener máximo 20 caracteres.',
            'primerNombre.string'      => 'El primer nombre debe ser string.',
            'segundoNombre.required'   => 'El segundo nombre es obligatorio.',
            'segundoNombre.min'        => 'El segundo nombre debe tener mínimo 3 caracteres.',
            'segundoNombre.max'        => 'El segundo nombre debe tener máximo 20 caracteres.',
            'segundoNombre.string'     => 'El segundo nombre debe ser string.',
            'primerApellido.required'  => 'El primer apellido es obligatorio.',
            'primerApellido.min'       => 'El primer apellido debe tener mínimo 3 caracteres.',
            'primerApellido.max'       => 'El primer apellido debe tener máximo 20 caracteres.',
            'primerApellido.string'    => 'El primer apellido debe ser string.',
            'segundoApellido.required' => 'El segundo apellido es obligatorio.',
            'segundoApellido.min'      => 'El segundo apellido debe tener mínimo 3 caracteres.',
            'segundoApellido.max'      => 'El segundo apellido debe tener máximo 20 caracteres.',
            'segundoApellido.string'   => 'El segundo apellido debe ser string.',
            'email.required'           => 'El email es obligatorio.',
            'email.email'              => 'Debe ingresar un email válido.',
            'email.unique'             => 'El email que ingresó ya fue registrado en otro usuario.',
            'email.min'                => 'El email debe tener mínimo 6 caracteres.',
            'email.max'                => 'El email debe tener máximo 50 caracteres.',
            'email.string'             => 'El email debe ser string.',
            'password.required'        => 'Debe ingresar su contraseña.',
            'password.min'             => 'La contraseña debe tener mínimo 8 caracteres.',
            'password.confirmed'       => 'La confirmación de contraseña no coincide.',
            'password.string'          => 'La contraseña debe ser string.',
        ];
    }
}
