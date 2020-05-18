<?php

namespace App\Policies;

use App\Models\Advisory;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class AdvisoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Advisory $advisory)
    {
        return $user->id === $advisory->user_id;
    }

    public function create(User $user)
    {
        return $user->id > 0;
    }

    public function update(User $user, Advisory $advisory)
    {
        return $user->id === $advisory->user_id;
    }

    public function delete(User $user, Advisory $advisory)
    {
        return $user->id === $advisory->user_id;
    }

    public function restore(User $user, Advisory $advisory)
    {
        //
    }

    public function forceDelete(User $user, Advisory $advisory)
    {
        //
    }
}
