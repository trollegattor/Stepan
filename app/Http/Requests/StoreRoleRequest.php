<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('create',Role::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'name'=>['required', 'string', 'max:50','unique:App\Models\Role,name'],

            'category_index'=>['boolean'],
            'category_store'=>['boolean'],
            'category_show'=>['boolean'],
            'category_update'=>['boolean'],
            'category_destroy'=>['boolean'],


            'menu_index'=>['boolean'],
            'menu_store'=>['boolean'],
            'menu_show'=>['boolean'],
            'menu_update'=>['boolean'],
            'menu_destroy'=>['boolean'],


            'article_index'=>['boolean'],
            'article_store'=>['boolean'],
            'article_show'=>['boolean'],
            'article_update_all'=>['boolean'],
            'article_update_own'=>['boolean'],
            'article_destroy_all'=>['boolean'],
            'article_destroy_own'=>['boolean'],

            'user_index'=>['boolean'],
            'user_store'=>['boolean'],
            'user_show_all'=>['boolean'],
            'user_show_own'=>['boolean'],
            'user_update_all'=>['boolean'],
            'user_update_own'=>['boolean'],
            'user_destroy_all'=>['boolean'],
            'user_destroy_own'=>['boolean'],

            'role_index'=>['boolean'],
            'role_store'=>['boolean'],
            'role_show'=>['boolean'],
            'role_update'=>['boolean'],
            'role_destroy'=>['boolean'],
        ];
    }
}
