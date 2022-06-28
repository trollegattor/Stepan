<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    public $fillable = [
        'name',
        'category_index',
        'category_store',
        'category_show',
        'category_update',
        'category_destroy',


        'menu_index',
        'menu_store',
        'menu_show',
        'menu_update',
        'menu_destroy',


        'article_index',
        'article_store',
        'article_show',
        'article_update_all',
        'article_update_own',
        'article_destroy_all',
        'article_destroy_own',

        'user_index',
        'user_store',
        'user_show_all',
        'user_show_own',
        'user_update_all',
        'user_update_own',
        'user_destroy_all',
        'user_destroy_own',

        'role_index',
        'role_store',
        'role_show',
        'role_update_all',
        'role_destroy_all',

    ];
    /**
     * @var string[]
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return HasMany
     */
    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

}
