<?php

namespace App\Rules;

use App\Models\Credito;
use App\Models\CuentaUser;
use App\Models\PlazoFijo;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidarIngresoPlazoFijoSiExisteCredito implements DataAwareRule, ValidationRule
{
    protected $data = [];

    public function setData(array $data): static
    {
        $this->data = $data;
 
        return $this;
    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
        $credito=Credito::where('numero',$this->data['numero_credito'])->first();

        if(!$credito){
            $fail('No existe crédito con el número '.$this->data['numero_credito']);
        }else{

            $cuenta_user=CuentaUser::find($this->data['cuenta_user']);
            if(!$cuenta_user){
                $fail('No existe la ceunta usuario ingresado');
            }else{
                if($credito->cuentaUser->user->id!=$cuenta_user->user->id){
                    $fail('El usuario selecionado no corresponde al usuario del crédito N°' .$credito->numero);
                }else{
                    if($credito->total_certificado_plazo_fijo==$this->data['monto']){
                        $plazoFijoExiste=PlazoFijo::where('credito_id',$credito->id)->where('cuenta_user_id',$cuenta_user->id)->first();
                        if($plazoFijoExiste){
                            $fail('Ya existe un certificado de plazo fijo con esta información. N° Certificado P.F '.$plazoFijoExiste->numero);
                        }
                    }else{
                        $fail('El monto ingresado no corresponde con el total del certificado a plazo fijo del crédito N° '.$credito->numero);
                    }
                }
            }
        }

    }
}
