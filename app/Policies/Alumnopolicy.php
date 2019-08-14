<?php

namespace App\Policies;

use App\User;
use App\Alumno;

use Illuminate\Auth\Access\HandlesAuthorization;

class Alumnopolicy
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
    public function before( $user, $ability){

        if($user->isAdmin()){
            return true; 
        } 

    }

   public function edit(User $user, Alumno $id)
    {
        
        return $user->id === $id->id;
    }

    public function update(User $user, Alumno $id)
    {
        return $user->id === $id->id;
    }

    public function destroy(User $user, Alumno $id)
    {
        
        return $user->id === $id->id;
    }
}
