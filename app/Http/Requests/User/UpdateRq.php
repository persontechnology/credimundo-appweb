<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRq extends FormRequest
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
            'name'=>'nullable|string|max:255',
            'email'=>'nullable|string|max:255|unique:users,email,'.$this->id,
            'password'=>'nullable|string|max:255',
            'nombres'=>'required|string|max:255',
            'apellidos'=>'required|string|max:255',
            'identificacion'=>'required|string|max:255|ecuador:ci|unique:users,identificacion,'.$this->id,
            'provincia'=>'required|string|max:255',
            'canton'=>'required|string|max:255',
            'parroquia'=>'required|string|max:255',
            'recinto'=>'required|string|max:255',
            'direccion'=>'required|string|max:255',
            'telefono'=>'nullable|string|max:255',
            'celular'=>'nullable|string|max:255',
            'lugar_nacimiento'=>'required|string|max:255',
            'fecha_nacimiento'=>'required|date',
            'nacionalidad'=>'required|string|max:255',
            'estado_civil'=>'required|in:SOLTERO,CASADO,DIVORCIADO,VIUDO,UNIÓN LIBRE',
            'foto'=>'nullable|image|max:2048',
            'foto_identificacion'=>'nullable|image|max:2048',
            'estado'=>'required|in:ACTIVO,INACTIVO',
            'sexo'=>'required|in:HOMBRE,MUJER',
            'nombre_conyuge'=>'nullable|string|max:255',
            'identificacion_conyuge'=>'nullable|string|max:255|ecuador:ci',
            'celular_conyuge'=>'nullable|string|max:255',
            'nombre_representante'=>'required|string|max:255',
            'identificacion_representante'=>'nullable|string|max:255|ecuador:ci',
            'parentesco_representante'=>'nullable|string|max:255',
            'celular_representante'=>'nullable|string|max:255',
            "roles"    => "required|array",
            "roles.*"  => "nullable|exists:roles,id",
        ];
    }

    public function messages(): array
    {
        return [
            'identificacion.ecuador'=>'Identificación incorrecta',
            'identificacion_conyuge'=>'Identificación de conyuge incorrecta',
            'identificacion_representante'=>'Identificación del representante incorrecta'
        ];
    }
}
