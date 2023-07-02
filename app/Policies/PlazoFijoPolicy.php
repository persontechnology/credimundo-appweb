<?php

namespace App\Policies;

use App\Models\PlazoFijo;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PlazoFijoPolicy
{
    public function eliminar(User $user,PlazoFijo $plazoFijo): bool
    {
        if($plazoFijo->estado==='INGRESADO'){
            return true;
        }
        return false;
    }

    public function editar(User $user,PlazoFijo $plazoFijo): bool
    {
        if($plazoFijo->estado==='INGRESADO'){
            return true;
        }
        return false;
    }
    
}
