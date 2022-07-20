<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CierreTurnoCobro extends FormRequest
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
            'idUsuarioCreacion'   => 'required',
            'observacionCierre'  => 'required',
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
            "idUsurioCreacion.required"     => "El usuario es requerido",
            "observacionCierre.required"    => "La observacion de cierre es requerida",
        ];
    }
}
