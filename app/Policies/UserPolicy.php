<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function view(User $authUser, User $targetUser): bool
    {
        return $authUser->hasAnyRole(['admin', 'manager']);
    }

    public function delete(User $authUser, User $targetUser): bool
    {

        return $authUser->hasAnyRole(['admin']) && $authUser->id !== $targetUser->id;
    }
}
