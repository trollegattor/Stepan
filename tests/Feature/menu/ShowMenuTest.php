<?php

namespace Tests\Feature\menu;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ShowMenuTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMenuShowSuccessfulGet()
    {
        Menu::factory()->create();
        $this->getJson('/api/menu/1')
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testMenuShowFailedValid()
    {
        Menu::factory()->create();
        $this->getJson('/api/menu/7777777' )
            ->assertJsonValidationErrors(['id']);
    }
}
