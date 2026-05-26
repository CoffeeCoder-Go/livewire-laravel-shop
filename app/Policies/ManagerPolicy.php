<?php

namespace App\Policies;

use App\Enums\PerfilType;
use App\Models\Perfil;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ManagerPolicy
{
    public function accessProducts(User $user,Perfil $perfil){
        return $perfil->type === PerfilType::Seller;
    }    
}
