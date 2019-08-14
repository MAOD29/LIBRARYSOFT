<?php

namespace App\Policies;

use App\User;
use App\Libro;
use App\Materia;
use Illuminate\Auth\Access\HandlesAuthorization;

class Libropolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function todo(User $user, Libro $id)
    {
        if($user->isAdmin()){
            return true; 
        } 
        //return $user->id === $id->id;
    }

    
}
