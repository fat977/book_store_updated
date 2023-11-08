<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdminPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    /* public function viewAny(Admin $admin): bool
    {
        //
        return $admin->type == 'super admin';
    } */

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin): bool
    {
        //
        return $admin->type == 'super admin';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        //
        return $admin->type == 'super admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin): bool
    {
        //
        return $admin->type == 'super admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin): bool
    {
        //
        return $admin->type == 'super admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
   /*  public function restore(User $user, Admin $admin): bool
    {
        //
    } */

    /**
     * Determine whether the user can permanently delete the model.
     */
   /*  public function forceDelete(User $user, Admin $admin): bool
    {
        //
    } */
}
