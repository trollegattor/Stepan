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
            'parent_id' => Category::PARENT_ID['NULL'],
        ]);
        $firstSubCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'About Ukraine',
            'parent_id' => $newsCategory->id,
        ]);
        $aboutUsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['SINGLE'],
            'name' => 'About us',
            'parent_id' => Category::PARENT_ID['NULL'],
        ]);
        $contactsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['SINGLE'],
            'name' => 'Contacts',
            'parent_id' => Category::PARENT_ID['NULL'],
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
        $superuserRole=Role::query()->create(['role'=>'Superuser']);
        Role::query()->create(['role'=>'Administrator']);
        Role::query()->create(['role'=>'Moderator']);
        Role::query()->create(['role'=>'Writer']);
        Role::query()->create(['role'=>'Redactor']);
        Category::factory()->count(10)->create();
        $guestRole=Role::query()->create(['role'=>'Guest']);
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
