<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCliente extends FormRequest
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
            'idTipoIdentificacion'      => 'required',
            'identificacion'            => 'required',
            'nombres'                   => 'required | max:75',
            'apellidos'                 => 'required | max:75',
        ] ;
    }


    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            "idTipoIdentificacion.required"     => "El tipo de identificacion es requirido",
            "identificacion.required"           => "El numero de identificacion es requirido",
            "nombres.required"                  => "El nombre del cliente es requerido",
            "apellidos.required"                => "El apellido del cliente es requerido"
        ];
    }

}
