<?php

namespace App\Policies;

use App\Models\TipoTransaccion;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TipoTransaccionPolicy
{
   protected $codigos=[
        'DEP/EFE',
        'RET/EFE',
        'DEP/CHEQ',
        'RET/CHEQ',
        'DEP/CPF',
        'RET/CPF',
        'ABON/CREO',
        'PAG/CRE',
        'COM/TOI',
        'APE/CUE',
   ];
    public function update(User $user, TipoTransaccion $tipoTransaccion): bool
    {
        if(in_array($tipoTransaccion->codigo,$this->codigos)){
            return false;
        }
        return true;
    }

    public function delete(User $user, TipoTransaccion $tipoTransaccion): bool
    {
        if(in_array($tipoTransaccion->codigo,$this->codigos)){
            return false;
        }
        return true;
    }

    
}
