<?php

namespace App\Policies;

use App\Http\Requests\ShowCategoryRequest;
use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use App\Services\CategoryService\CategoryService;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * @param User $user
     * @param Category $category
     * @return bool
     */
    public function view(User $user, Category $category)
    {
        return true;
    }


    public function create(User $user)
    {
        return $user->role->category_store;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Category $category
     * @return bool
     */
    public function update(User $user, Category $category): bool
    {
        return $user->role->category_update;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Category $category
     * @return Response|bool
     */
    public function delete(User $user, Category $category)
    {
        return $user->role->category_destroy;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Category $category
     * @return Response|bool
     */
    public function restore(User $user, Category $category)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Category $category
     * @return Response|bool
     */
    public function forceDelete(User $user, Category $category)
    {
        //
    }
}
