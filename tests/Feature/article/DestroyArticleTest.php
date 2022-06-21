<?php

namespace Tests\Feature\article;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DestroyArticleTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function testArticleDestroySuccessfully()
    {
        $article=Article::factory()->create();
        $this->deleteJson('/api/article/1')
            ->assertStatus(200)
            ->assertJsonMissing($article->attributesToArray());
    }

    /**
     * @return void
     */
    public function testArticleDestroyFailedValid()
    {
        Article::factory()->create();
        $this->deleteJson('/api/category/7777777')
            ->assertJsonValidationErrors(['id']);
    }
}
