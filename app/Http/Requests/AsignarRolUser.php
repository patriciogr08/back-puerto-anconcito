<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AsignarRolUser extends FormRequest
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
            'name'        => 'required|without_spaces|min:3|max:100',
        ];
    }

    
    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            "name.required"        => "El código del rol es requerido.",
            'name.min'             => 'El código debe tener mínimo 3 caracteres.',
            'name.max'             => 'El código debe tener máximo 100 caracteres.',
        ];
    }
}
