<?php

namespace App\Policies;

use App\Models\TipoCuenta;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TipoCuentaPolicy
{
    protected $codigos=[
        'AHO/VIS',
        'CUE/INF',
        'AHO/PRO'
    ];

    public function update(User $user, TipoCuenta $tipoCuenta): bool
    {
        if (in_array($tipoCuenta->codigo, $this->codigos)) {
            return false;
        }
        return true;
    }
    
    public function delete(User $user, TipoCuenta $tipoCuenta): bool
    {
        if (in_array($tipoCuenta->codigo, $this->codigos)) {
            return false;
        }
        return true;
    }

    
}
