<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->name,

            'category_index' => $this->category_index,
            'category_store' => $this->category_store,
            'category_show' => $this->category_show,
            'category_update' => $this->category_update,
            'category_destroy' => $this->category_destroy,

            'menu_index' => $this->menu_index,
            'menu_store' => $this->menu_store,
            'menu_show' => $this->menu_show,
            'menu_update' => $this->menu_update,
            'menu_destroy' => $this->menu_destroy,

            'article_index' => $this->article_index,
            'article_store' => $this->article_store,
            'article_show' => $this->article_show,
            'article_update_all' => $this->article_update_all,
            'article_update_own' => $this->article_update_own,
            'article_destroy_all' => $this->article_destroy_all,
            'article_destroy_own' => $this->article_destroy_own,

            'user_index' => $this->user_index,
            'user_store' => $this->user_store,
            'user_show_all' => $this->user_show_all,
            'user_show_own' => $this->user_show_own,
            'user_update_all' => $this->user_update_all,
            'user_update_own' => $this->user_update_own,
            'user_destroy_all' => $this->user_destroy_all,
            'user_destroy_own' => $this->user_destroy_own,

            'role_index' => $this->role_index,
            'role_store' => $this->role_store,
            'role_show' => $this->role_show,
            'role_update' => $this->role_update,
            'role_destroy' => $this->role_destroy,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
