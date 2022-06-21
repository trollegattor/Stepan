<?php

namespace Tests\Feature\menu;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DestroyMenuTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function testCategoryDestroySuccessfully()
    {
        $menu = Menu::factory()->create();
        $this->deleteJson('/api/menu/1')
            ->assertStatus(200)
            ->assertJsonMissing($menu->attributesToArray());
    }

    /**
     * @return void
     */
    public function testCategoryDestroyFailedValid()
    {
        Menu::factory()->create();
        $this->deleteJson('/api/menu/7777777')
            ->assertJsonValidationErrors(['id']);
    }
}
