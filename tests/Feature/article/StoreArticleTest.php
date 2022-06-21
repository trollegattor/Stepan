<?php

namespace Tests\Feature\article;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreArticleTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testArticleStoreCreate()
    {
        $newsCategory = Category::factory()->create();
        $this->post('/api/article', [
            'category_id' => $newsCategory->id,
            'title' => 'Lust news',
            'content' => 'Hello from Stepan',
            'author' => Article::ARTICLE_AUTHOR['ADMIN'],
        ])
            ->assertJson(['data' => [
                'id' => 1,
                'category_id' => $newsCategory->id,
                'title' => 'Lust news',
                'content' => 'Hello from Stepan',
                'author' => Article::ARTICLE_AUTHOR['ADMIN']
            ]]);
    }

    /**
     * @return void
     */
    public function testArticleStoreFailedValidFirst()
    {
        Category::factory()->create();
        $this->postJson('/api/article', [])
            ->assertJsonValidationErrors([
                'category_id',
                'title',
                'content',
                'author'
            ]);
    }

    /**
     * @return void
     */
    public function testArticleStoreFailedValidSecond()
    {
        Category::factory()->create();
        $count = Category::query();
        $this->postJson('/api/article', [
            'category_id' => 7777777,
            'title' => 123,
            'content' => 123,
            'author' => 123,
        ])
            ->assertJsonValidationErrors([
                'category_id',
                'title',
                'content',
                'author'
            ]);
    }

    /**
     * @return void
     */
    public function testArticleStoreFailedValidThird()
    {
        Category::factory()->create();
        $this->postJson('/api/article', [
            'category_id' => 1,
            'title' => $this->faker->realTextBetween(201, 300),
            'content' => $this->faker->realTextBetween(15001, 15101),
            'author' => 'error',
        ])
            ->assertJsonValidationErrors([
                'title',
                'content',
                'author'
            ]);
    }
}
