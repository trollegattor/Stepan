<?php

namespace Tests\Feature\category;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowCategoryTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCategoryShowSuccessfulGet()
    {
        Category::factory()->create();
        $this->getJson('/api/category/1')
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testCategoryShowFailedValid()
    {
        $this->getJson('/api/category/7777777')
            ->assertJsonValidationErrors(['id']);
    }
}
