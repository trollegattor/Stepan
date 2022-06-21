<?php

namespace Tests\Feature\article;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ShowArticleTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testArticleShowSuccessfulGet()
    {
        Article::factory()->create();
        $this->getJson('/api/article/1' )
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testArticleShowFailedValid()
    {
        Article::factory()->create();
        $this->getJson('/api/article/7777777')
            ->assertJsonValidationErrors(['id']);
    }
}
