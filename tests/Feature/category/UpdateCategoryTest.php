<?php

namespace Tests\Feature\category;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateCategoryTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCategoryUpdateSuccessful()
    {
        Category::factory()->count(2)->create(['name' => 'News']);
        $newData = [
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'Sport',
            'parent_id' => 1,
        ];
        $this->patchJson('/api/category/2', $newData)
            ->assertExactJson(['data' => [
                'id' => 2,
                'type' => Category::CATEGORY_TYPES['MULTI'],
                'name' => 'Sport',
                'parent_id' => 1,
            ]]);
    }

    /**
     * @return void
     */
    public function testCategoryUpdateFailedValidFirst()
    {
        Category::factory()->create(['name' => 'News']);
        $newData = [
            'parent_id' => 'error',
        ];
        $this->patchJson('/api/category/7777777', $newData)
            ->assertJsonValidationErrors(['id','name', 'type', 'parent_id']);
    }

    /**
     * @return void
     */
    public function testCategoryUpdateFailedValidSecond()
    {
        Category::factory()->create(['name' => 'News']);
        $newData = [
            'name' => 111,
            'type' => 111,
            'parent_id' => [],
        ];
        $this->patchJson('/api/category/3', $newData)
            ->assertJsonValidationErrors(['name', 'type', 'parent_id']);
    }

    /**
     * @return void
     */
    public function testCategoryUpdateFailedValidThird()
    {
        Category::factory()->create(['name' => 'News']);
        $newData = [
            'name' => $this->faker->realTextBetween(201, 300),
            'type' => 'error',
            'parent_id' => 2,
        ];
        $this->patchJson('/api/category/3' , $newData)
            ->assertJsonValidationErrors(['name', 'type', 'parent_id']);
    }

}
