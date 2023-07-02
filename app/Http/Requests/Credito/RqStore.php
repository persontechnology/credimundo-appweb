<?php

namespace App\Http\Requests\Credito;

use Illuminate\Foundation\Http\FormRequest;

class RqStore extends FormRequest
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
        $rg_decimal="/^[0-9,]+(\.\d{0,2})?$/";
        return [
            'cuenta_user'=>'required|exists:cuenta_users,id',
            'numero_cuenta'=>'nullable',
            'monto'=>'required|numeric|gt:0|regex:'.$rg_decimal,
            'plazo'=>'required',
            'tipo_credito'=>'required|exists:tipo_creditos,tasa_efectiva_anual',
            'apellidos_nombres'=>'nullable',
            'interes_certificado_plazo_fijo'=>'required|numeric|gt:0|regex:'.$rg_decimal,
            'total_certificado_plazo_fijo'=>'required|numeric|gt:0|regex:'.$rg_decimal,
            'dia_pago'=>'required|date',
            'detalle'=>'nullable|string|max:255',
            'actividad'=>'required|string|max:255',
            'neto_recibir'=>'required|numeric|gt:0|regex:'.$rg_decimal,
            'pago_mensual'=>'required|numeric|gt:0|regex:'.$rg_decimal,
            'numero_cuotas'=>'required|numeric|gt:0',
            'pago_total'=>'required|numeric|gt:0|regex:'.$rg_decimal,
            'interes_total'=>'required|numeric|gt:0|regex:'.$rg_decimal,
            'numero_pago_tabla'=>'required|array',
            'numero_pago_tabla.*'=>'required|numeric|gt:0|regex:'.$rg_decimal,
            'fecha_pago_tabla'=>'required|array',
            'fecha_pago_tabla.*'=>'required|date',
            'pago_mensual_tabla'=>'required|array',
            'pago_mensual_tabla.*'=>'required|numeric|gte:0|regex:'.$rg_decimal,
            'interes_tabla'=>'required|array',
            'interes_tabla.*'=>'required|numeric|gte:0|regex:'.$rg_decimal,
            'total_de_pago_tabla'=>'required|array',
            'total_de_pago_tabla.*'=>'required|numeric|gte:0|regex:'.$rg_decimal,
            'saldo_capital_tabla'=>'required|array',
            'saldo_capital_tabla.*'=>'required|numeric|gte:0|regex:'.$rg_decimal,
            'total_pago_tabla'=>'required|array',
            'total_pago_tabla.*'=>'required|numeric|gte:0|regex:'.$rg_decimal,
        ];
    }
}
