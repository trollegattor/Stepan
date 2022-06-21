<?php

namespace Tests\Feature\article;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateArticleTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testArticleUpdateSuccessful()
    {
        Article::factory()->create();
        $this->patchJson('/api/article/1', [
            'category_id' => 1,
            'title' => 'Last news',
            'content' => 'Hello from Stepan',
            'author' => Article::ARTICLE_AUTHOR['ADMIN'],
        ])
            ->assertJson(['data' => [
                'id' => 1,
                'category_id' => 1,
                'title' => 'Last news',
                'content' => 'Hello from Stepan',
                'author' => Article::ARTICLE_AUTHOR['ADMIN'],
            ]]);
    }

    /**
     * @return void
     */
    public function testArticleUpdateFailedValidFirst()
    {
        Article::factory()->create();
        $this->patchJson('/api/article/7777777', [])
            ->assertJsonValidationErrors([
                'id',
                'category_id',
                'title',
                'content',
                'author'
            ]);
    }

    /**
     * @return void
     */
    public function testArticleUpdateFailedValidSecond()
    {
        Article::factory()->create();
        $this->patchJson('/api/article/1', [
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
    public function testArticleUpdateFailedValidThird()
    {
        Article::factory()->create();
        $this->patchJson('/api/article/1', [
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
