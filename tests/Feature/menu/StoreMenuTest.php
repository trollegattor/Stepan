<?php

namespace Tests\Feature\menu;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreMenuTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMenuStoreCreate()
    {
        $newsCategory = Category::factory()->create();
        $this->post('/api/menu', [
            'category_id' => $newsCategory->id,
            'title' => 'News',
        ])
            ->assertExactJson(['data' => [
                'id' => 1,
                'category_id' => $newsCategory->id,
                'title' => 'News',
            ]]);
    }

    /**
     * @return void
     */
    public function testCategoryStoreFailedValidFirst()
    {
        Category::factory()->create();
        $this->postJson('/api/menu', [])
            ->assertJsonValidationErrors(['category_id', 'title']);
    }

    /**
     * @return void
     */
    public function testCategoryStoreFailedValidSecond()
    {
        $newsCategory = Category::factory()->create();
        $this->postJson('/api/menu', [
            'category_id' => $newsCategory->id + 1,
            'title' => 123456
        ])
            ->assertJsonValidationErrors(['category_id', 'title']);
    }

    /**
     * @return void
     */
    public function testCategoryStoreFailedValidThird()
    {
        $newsCategory = Category::factory()->create();
        $this->postJson('/api/menu', [
            'category_id' => $newsCategory->id,
            'title' => $this->faker->realTextBetween(201, 300)
        ])
            ->assertJsonValidationErrors(['title']);
    }
}
