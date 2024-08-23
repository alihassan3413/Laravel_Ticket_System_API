<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use App\Permissions\Abilities;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }


    public function store(User $user)
    {
        return $user->tokenCan(Abilities::CreateUser);
    }


    public function replace(User $user, User $model)
    {
        return $user->tokenCan(Abilities::ReplaceUser);
    }

    public function update(User $user, User $mdoel)
    {
        return $user->tokenCan(Abilities::UpdateUser);

    }

    public function delete(User $user, User $model)
    {
        return $user->tokenCan(Abilities::DeleteUser);
    }
}
