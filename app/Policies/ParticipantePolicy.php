<?php

namespace App\Policies;

use App\Models\Partipante;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ParticipantePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Partipante $partipante): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
          return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Partipante $partipante): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Partipante $partipante): bool
    {
        //

        return $user->id === $partipante->evento->user_id || $user->id ===$partipante->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Partipante $partipante): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Partipante $partipante): bool
    {
        //
    }
}
