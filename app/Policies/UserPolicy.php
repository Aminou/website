<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\User  $viewer
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $viewer, User $user)
    {
        //
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\User  $owner
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $owner, User $user)
    {
        return $owner->id === $user->id;
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\User  $owner
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $owner, User $user)
    {
        return $owner->id === $user->id;
    }
}
