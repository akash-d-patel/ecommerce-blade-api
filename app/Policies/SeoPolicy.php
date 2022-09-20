<?php

namespace App\Policies;

use App\Models\Seo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeoPolicy
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
     * @param  \App\Models\Seo  $seo
     * @return mixed
     */
    public function view(User $user, Seo $seo)
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
     * @param  \App\Models\Seo  $seo
     * @return mixed
     */
    public function update(User $user, Seo $seo)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Seo  $seo
     * @return mixed
     */
    public function delete(User $user, Seo $seo)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Seo  $seo
     * @return mixed
     */
    public function restore(User $user, Seo $seo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Seo  $seo
     * @return mixed
     */
    public function forceDelete(User $user, Seo $seo)
    {
        //
    }
}
