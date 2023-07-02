<?php

namespace App\Policies;

use App\Models\Credito;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CreditoPolicy
{
    public function asignarGarantes(User $user,Credito $credito): bool
    {
        if($credito->estado==='INGRESADO'||$credito->estado==='APROBADO'){
            return true;
        }
        return false;
    }

    public function eliminar(User $user,Credito $credito): bool
    {
        if($credito->estado==='INGRESADO'){
            return true;
        }
        return false;
    }

    public function editar(User $user,Credito $credito): bool
    {
        if($credito->estado==='INGRESADO'){
            return true;
        }
        return false;
    }

}
