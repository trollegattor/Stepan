<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * @return bool
     */
    public function viewAny(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function view(): bool
    {
        return true;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->role->category_store;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function update(User $user): bool
    {
        return $user->role->category_update;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->role->category_destroy;
    }
}
