<?php

namespace App\Policies;


use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
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
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->role->article_store;
    }

    /**
     * @param User $user
     * @param Article $article
     * @return bool
     */
    public function update(User $user, Article $article): bool
    {
        return $user->role->article_update_all
            || ($user->role->article_update_own and $user->id == $article->user_id);

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Article $article
     * @return bool
     */
    public function delete(User $user, Article $article): bool
    {
        return $user->role->article_destroy_all
            || ($user->role->article_destroy_own and $user->id == $article->user_id);
    }
}
