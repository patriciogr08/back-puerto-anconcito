<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRole extends FormRequest
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
        return $this->obtenerReglasEspecificas($this->method());
    }

    public function obtenerReglasEspecificas($method)
    {
        $rules = [];
        switch($method) {
            case "PUT":
                $rules = [
                    'name'        => 'required|without_spaces|min:3|max:100',
                    'description' => 'required|min:3|max:150',
                ];
                break;
            
            default :
                $rules = [
                    'name'        => 'required|without_spaces|unique:roles|min:3|max:100',
                    'description' => 'required|min:3|max:150',
                ];
                break;
        }

        return $rules;
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            "name.required"        => "El código es requerido.",
            'name.unique'          => 'El código que ingresó ya existe.',
            "name.without_spaces"  => "El código no debe contener espacios en blanco.",
            'name.min'             => 'El código debe tener mínimo 3 caracteres.',
            'name.max'             => 'El código debe tener máximo 100 caracteres.',
            "description.required" => "El nombre es requerido.",
            'description.min'      => 'El nombre debe tener mínimo 3 caracteres.',
            'description.max'      => 'El nombre debe tener máximo 150 caracteres.',
        ];
    }
}