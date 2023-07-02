<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    
    public function update(User $user, User $model): bool
    {

        if($user->id===$model->id){
            return true;
        }else{
            if($model->hasRole('ADMINISTRADOR')){
                return false;
            }
        }
        return true;
    }
    public function delete(User $user, User $model): bool
    {
        if($model->hasRole('ADMINISTRADOR') || $user->id===$model->id){
            return false;
        }
        return true;
    }
}
