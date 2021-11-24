<?php

namespace App\Policies;

use App\Models\Origin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OriginPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->containsPermission('origin_viewAny');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Origin  $origin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Origin $origin)
    {
        return $user->containsPermission('origin_viewAny');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->containsPermission('origin_create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Origin  $origin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Origin $origin)
    {
        return $user->containsPermission('origin_update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Origin  $origin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Origin $origin)
    {
        return $user->containsPermission('origin_delete');
    }
}
