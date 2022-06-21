<?php

namespace Tests\Feature\menu;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateMenuTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /**
     * @return void
     */
    public function testMenuUpdateSuccessful()
    {
        Menu::factory()->create();
        $newData = [
            'category_id' => 1,
            'title' => 'New contacts',
        ];
        $this->patchJson('/api/menu/1', $newData)
            ->assertExactJson(['data' => [
                'id' => 1,
                'category_id' => 1,
                'title' => 'New contacts',
            ]]);
    }

    /**
     * @return void
     */
    public function testMenuUpdateFailedValidFirst()
    {
        Menu::factory()->create();
        $this->patchJson('/api/menu/7777777', [])
            ->assertJsonValidationErrors(['id', 'category_id', 'title']);
    }

    /**
     * @return void
     */
    public function testMenuUpdateFailedValidSecond()
    {
        Menu::factory()->create();
        $newData = [
            'category_id' => 2,
            'title' => 123456,
        ];
        $this->patchJson('/api/menu/1', $newData)
            ->assertJsonValidationErrors(['category_id', 'title']);
    }

    /**
     * @return void
     */
    public function testMenuUpdateFailedValidThird()
    {
        Menu::factory()->create();
        $newData = [
            'category_id' => 1,
            'title' => $this->faker->realTextBetween(201, 300),
        ];
        $this->patchJson('/api/menu/1', $newData)
            ->assertJsonValidationErrors(['title']);
    }

}
