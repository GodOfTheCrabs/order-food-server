<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'creator']);
    }

    public function edit(User $user, Category $category): bool
    {
        return $user->hasAnyRole(['admin', 'editor']);
    }
    
    public function delete(User $user, Category $category): bool
    {
        return $user->hasAnyRole(['admin']);
    }
}
