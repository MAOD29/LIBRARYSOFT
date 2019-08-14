<?php

namespace App\Policies;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class Userpolicy
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

    public function before($user, $ability){

        if($user->isAdmin()){
            return true; 
        } 

    }

   public function edit(User $user, User $id)
    {
        
        return $user->id === $id->id;
    }

    public function update(User $user, User $id)
    {
        return $user->id === $id->id;
    }

    public function destroy(User $user, User $id)
    {
        
        return $user->id === $id->id;
    }
}
