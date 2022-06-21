<?php

namespace Tests\Feature\category;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DestroyCategoryTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function testCategoryDestroySuccessfully()
    {
        $category=Category::factory()->create(['name' => 'News']);
        $this->deleteJson('/api/category/1')
            ->assertStatus(200)
            ->assertJsonMissing($category->attributesToArray());
    }

    /**
     * @return void
     */
    public function testCategoryDestroyFailedValid()
    {
        Category::factory()->create(['name' => 'News']);
        $this->deleteJson('/api/category/7777777')
            ->assertJsonValidationErrors(['id']);
    }


}
