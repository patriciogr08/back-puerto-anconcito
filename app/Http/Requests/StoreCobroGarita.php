<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCobroGarita extends FormRequest
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
            'idCliente'         => 'required',
            'idTipoVehiculo'    => 'required',
            'placaVehiculo'     => 'required',
            'valor'             => 'required',
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
            "idCliente.required"        => "El cliente es requirido",
            "idTipoVehiculo.required"   => "El tipo de vehiculo es requirido",
            "valor.required"            => "El valor de entrada es requerido",
            "placaVehiculo.required"    => "La placa del vehiculo es requerido",
        ];
    }
}
