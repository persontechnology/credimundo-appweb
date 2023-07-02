<?php

namespace App\Http\Requests\Transaccion;

use App\Rules\ValidarTransaccionResta;
use Illuminate\Foundation\Http\FormRequest;

class StoreRq extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'cuentaUser'=>'required|exists:cuenta_users,id',
            'tipoTransaccion'=>'required|exists:tipo_transaccions,id',
            'detalle'=>'nullable|string|max:255',
            'valor'=>[
                'required',
                'numeric',
                'gt:0',
                new ValidarTransaccionResta
            ],
            'quienRealizaTransaccion'=>'required|in:titular,otro',
            'identificacion_otra_persona'  => 'nullable|ecuador:identificacion|required_if:quienRealizaTransaccion,otro',
            'nombre_otra_persona'  => 'nullable|string|max:255|required_if:quienRealizaTransaccion,otro'
        ];
    }
    public function messages()
    {
        return[
            'identificacion_otra_persona.ecuador'=>'Identificación de otra persona incorrecta.'
        ];
    }
}
