<?php

namespace Tests\Feature\category;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowCategoryTest extends TestCase
{
    use DatabaseMigrations, WithFaker;
    public array $data=[
        'type' => Category::CATEGORY_TYPES['MULTI'],
        'name' => 'News',
        'parent_id'=>Category::PARENT_ID['NULL'],
        ];

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCategoryShowSuccessfulGet()
    {
        Category::query()->create($this->data);
        Category::factory()->count(10)->create();
        $count=Category::query()->where('id','!=', null)->first();
        $this->getJson('/api/category/'.$count->id)
            ->assertStatus(200);
    }

    /**
     * @return void
     *
     */
    public function testCategoryShowSuccessfulValid()
    {
        $category=Category::query()->create($this->data);
        $this->getJson('/api/category/'.$category->id)
             ->assertJsonMissingValidationErrors(['id']);
    }

    /**
     * @return void
     */
    public function testCategoryShowFailedValid()
    {
        $this->getJson('/api/category/15686454544')
            ->assertJsonValidationErrors(['id']);
    }
}
