<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCrearContrato extends FormRequest
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
            'idEmpleado'         => 'required',
            'cv'                 => 'nullable',
            'referencias'        => 'nullable',
            'renovacion'         => 'required',
            'mesesContrato'      => 'required',
            'fechaInicio'        => 'required'
        ];
    }

    public function messages() {

        return [
            'idEmpleado.required'         => 'El usuario es obligatorio.',
            'renovacion.required'         => 'El campo renovacion es obligatorio',
            'mesesContrato.required'      => 'Los meses de contrato son  obligatorios',
            'fechaInicio.required'        => 'La fecha del inicio del contrato es obligatorio'          
        ];
    }
}
