<?php

namespace App\Policies;

use App\Models\RolePermission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RolePermission  $rolePermission
     * @return mixed
     */
    public function view(User $user, RolePermission $rolePermission)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RolePermission  $rolePermission
     * @return mixed
     */
    public function update(User $user, RolePermission $rolePermission)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RolePermission  $rolePermission
     * @return mixed
     */
    public function delete(User $user, RolePermission $rolePermission)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RolePermission  $rolePermission
     * @return mixed
     */
    public function restore(User $user, RolePermission $rolePermission)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RolePermission  $rolePermission
     * @return mixed
     */
    public function forceDelete(User $user, RolePermission $rolePermission)
    {
        //
    }
}
