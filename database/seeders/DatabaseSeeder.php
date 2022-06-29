<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $newsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'News',
            'parent_id' => null,
        ]);
        $firstSubCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'About Ukraine',
            'parent_id' => $newsCategory->id,
        ]);
        $aboutUsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['SINGLE'],
            'name' => 'About us',
            'parent_id' => null,
        ]);
        $contactsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['SINGLE'],
            'name' => 'Contacts',
            'parent_id' => null,
        ]);
        $aboutUsMenu = Menu::query()->create([
            'category_id' => $aboutUsCategory->id,
            'title' => 'About us',
        ]);
        $newsMenu = Menu::query()->create([
            'category_id' => $newsCategory->id,
            'title' => 'News',
        ]);
        $contactsMenu = Menu::query()->create([
            'category_id' => $contactsCategory->id,
            'title' => 'Contacts',
        ]);
        $superuserRole=Role::query()->create([
            'name'=>'Superuser',

            'category_index'=>true,
            'category_store'=>true,
            'category_show'=>true,
            'category_update'=>true,
            'category_destroy'=>true,


            'menu_index'=>true,
            'menu_store'=>true,
            'menu_show'=>true,
            'menu_update'=>true,
            'menu_destroy'=>true,


            'article_index'=>true,
            'article_store'=>true,
            'article_show'=>true,
            'article_update_all'=>true,
            'article_update_own'=>true,
            'article_destroy_all'=>true,
            'article_destroy_own'=>true,

            'user_index'=>true,
            'user_store'=>true,
            'user_show_all'=>true,
            'user_show_own'=>true,
            'user_update_all'=>true,
            'user_update_own'=>true,
            'user_destroy_all'=>true,
            'user_destroy_own'=>true,

            'role_index'=>true,
            'role_store'=>true,
            'role_show'=>true,
            'role_update'=>true,
            'role_destroy'=>true,

        ]);
        Role::query()->create([
            'name'=>'Administrator',
            'category_index'=>true,
            'category_store'=>true,
            'category_show'=>true,
            'category_update'=>true,
            'category_destroy'=>true,


            'menu_index'=>true,
            'menu_store'=>false,
            'menu_show'=>true,
            'menu_update'=>false,
            'menu_destroy'=>false,


            'article_index'=>true,
            'article_store'=>true,
            'article_show'=>true,
            'article_update_all'=>true,
            'article_update_own'=>true,
            'article_destroy_all'=>true,
            'article_destroy_own'=>true,

            'user_index'=>true,
            'user_store'=>true,
            'user_show_all'=>true,
            'user_show_own'=>true,
            'user_update_all'=>true,
            'user_update_own'=>true,
            'user_destroy_all'=>true,
            'user_destroy_own'=>true,

            'role_index'=>true,
            'role_store'=>false,
            'role_show'=>true,
            'role_update'=>true,
            'role_destroy'=>false,

        ]);
        Role::query()->create([
            'name'=>'Moderator',

            'category_index'=>true,
            'category_store'=>true,
            'category_show'=>true,
            'category_update'=>true,
            'category_destroy'=>false,


            'menu_index'=>true,
            'menu_store'=>false,
            'menu_show'=>true,
            'menu_update'=>false,
            'menu_destroy'=>false,


            'article_index'=>true,
            'article_store'=>true,
            'article_show'=>true,
            'article_update_all'=>true,
            'article_update_own'=>true,
            'article_destroy_all'=>true,
            'article_destroy_own'=>true,

            'user_index'=>true,
            'user_store'=>true,
            'user_show_all'=>true,
            'user_show_own'=>true,
            'user_update_all'=>true,
            'user_update_own'=>true,
            'user_destroy_all'=>true,
            'user_destroy_own'=>true,

            'role_index'=>false,
            'role_store'=>false,
            'role_show'=>false,
            'role_update'=>false,
            'role_destroy'=>false,


        ]);
        Role::query()->create([
            'name'=>'Writer',

            'category_index'=>true,
            'category_store'=>false,
            'category_show'=>true,
            'category_update'=>false,
            'category_destroy'=>false,


            'menu_index'=>true,
            'menu_store'=>false,
            'menu_show'=>true,
            'menu_update'=>false,
            'menu_destroy'=>false,


            'article_index'=>true,
            'article_store'=>true,
            'article_show'=>true,
            'article_update_all'=>false,
            'article_update_own'=>true,
            'article_destroy_all'=>false,
            'article_destroy_own'=>false,

            'user_index'=>false,
            'user_store'=>false,
            'user_show_all'=>false,
            'user_show_own'=>false,
            'user_update_all'=>false,
            'user_update_own'=>false,
            'user_destroy_all'=>false,
            'user_destroy_own'=>false,

            'role_index'=>false,
            'role_store'=>false,
            'role_show'=>false,
            'role_update'=>false,
            'role_destroy'=>false,

        ]);
        Role::query()->create([
            'name'=>'Redactor',

            'category_index'=>true,
            'category_store'=>false,
            'category_show'=>true,
            'category_update'=>false,
            'category_destroy'=>false,


            'menu_index'=>true,
            'menu_store'=>false,
            'menu_show'=>true,
            'menu_update'=>false,
            'menu_destroy'=>false,


            'article_index'=>true,
            'article_store'=>false,
            'article_show'=>true,
            'article_update_all'=>true,
            'article_update_own'=>true,
            'article_destroy_all'=>false,
            'article_destroy_own'=>false,

            'user_index'=>false,
            'user_store'=>false,
            'user_show_all'=>false,
            'user_show_own'=>false,
            'user_update_all'=>false,
            'user_update_own'=>false,
            'user_destroy_all'=>false,
            'user_destroy_own'=>false,

            'role_index'=>false,
            'role_store'=>false,
            'role_show'=>false,
            'role_update'=>false,
            'role_destroy'=>false,

        ]);
        $guestRole=Role::query()->create([
            'name'=>'User',

            'category_index'=>true,
            'category_store'=>false,
            'category_show'=>true,
            'category_update'=>false,
            'category_destroy'=>false,


            'menu_index'=>true,
            'menu_store'=>false,
            'menu_show'=>true,
            'menu_update'=>false,
            'menu_destroy'=>false,


            'article_index'=>true,
            'article_store'=>false,
            'article_show'=>true,
            'article_update_all'=>false,
            'article_update_own'=>false,
            'article_destroy_all'=>false,
            'article_destroy_own'=>false,

            'user_index'=>false,
            'user_store'=>false,
            'user_show_all'=>false,
            'user_show_own'=>false,
            'user_update_all'=>false,
            'user_update_own'=>false,
            'user_destroy_all'=>false,
            'user_destroy_own'=>false,

            'role_index'=>false,
            'role_store'=>false,
            'role_show'=>false,
            'role_update'=>false,
            'role_destroy'=>false,

        ]);
       User::factory()->create([
           'role_id'=>$superuserRole->id,
           'login' => 'ollegg',
            'password' => bcrypt('00000000'),
            'email' => 'oleg@gmail.com',
            'real_name' => 'oleg',
            'surname' =>'Malin' ,
       ]);
        Category::factory()->count(10)->create();
        $guestUser=User::factory()->create(['role_id'=>$guestRole->id]);
        $superuserUser=User::factory()->create(['role_id'=>$superuserRole->id]);
        Article::factory()->create([
            'category_id' => $aboutUsCategory->id,
            'user_id' => $guestUser->id,
        ]);
        Article::factory()->create([
            'category_id' => $contactsCategory->id,
            'user_id' => $superuserUser->id,
        ]);
        Article::factory()->count(10)->create(['category_id' => $newsCategory->id]);
        Article::factory()->count(10)->create(['category_id' => $firstSubCategory->id]);
        User::factory()->count(2)->create(['role_id'=>$guestRole->id]);
        User::factory()->count(2)->create(['role_id'=>$superuserRole->id]);
    }


}
