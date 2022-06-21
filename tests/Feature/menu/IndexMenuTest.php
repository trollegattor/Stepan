<?php

namespace Tests\Feature\menu;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class IndexMenuTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @return void
     */
    public function testMenuIndexGetSuccessfully()
    {
        $this->getJson('/api/menu')
            ->assertOk();
    }

    /**
     * @return void
     */
    public function testMenuIndexGetFailed()
    {
        $this->getJson('/api/error')
            ->assertNotFound();
    }
}
