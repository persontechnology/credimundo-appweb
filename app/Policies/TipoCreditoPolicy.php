<?php

namespace App\Policies;

use App\Models\TipoCredito;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TipoCreditoPolicy
{
    
    protected $nombres=[
        'MICROCREDITO',
        'CONSUMO',
        'EMERGENTE',
        'CERTIFICADO PLAZO FIJO'
    ];
    public function update(User $user, TipoCredito $tipoCredito): bool
    {
        if(in_array($tipoCredito->nombre,$this->nombres)){
            return false;
        }
        return true;
    }

   
    public function delete(User $user, TipoCredito $tipoCredito): bool
    {
        if(in_array($tipoCredito->nombre,$this->nombres)){
            return false;
        }
        return true;
    }
}
