<?php

namespace App\Policies;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Ad $ad): bool
    {
        return $ad->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Ad $ad): bool
    {
        return false;
    }

    public function delete(User $user, Ad $ad): bool
    {
        return false;
    }

    public function restore(User $user, Ad $ad): bool
    {
        return false;
    }

    public function forceDelete(User $user, Ad $ad): bool
    {
        return false;
    }
}
