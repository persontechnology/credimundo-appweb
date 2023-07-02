<?php

namespace App\Rules;

use App\Models\CuentaUser;
use App\Models\TipoTransaccion;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidarTransaccionResta implements DataAwareRule, ValidationRule
{
    protected $data = [];

    public function setData(array $data): static
    {
        $this->data = $data;
 
        return $this;
    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
        $tt=TipoTransaccion::findOrFail($this->data['tipoTransaccion']);
        $cuentaUser=CuentaUser::findOrFail($this->data['cuentaUser']);
        $valor=$this->data['valor'];

        if($tt->tipo=='RESTAR'){
            if($valor>$cuentaUser->valor_disponible){
                $fail('El valor de '.$valor.' no disponible de '.$cuentaUser->valor_disponible);
            }
        }
    }
}
