<?php

namespace Tests\Feature\article;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class IndexArticleTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @return void
     */
    public function testArticleIndexGet()
    {
        $this->getJson('/api/article')
            ->assertOk();
    }

    /**
     * @return void
     */
    public function testArticleIndexGetFailed()
    {
        $this->getJson('/api/error')
            ->assertNotFound();
    }
}
