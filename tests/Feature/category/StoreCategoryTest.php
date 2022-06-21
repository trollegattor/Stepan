<?php

namespace Tests\Feature\category;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreCategoryTest extends TestCase
{
    use DatabaseMigrations, WithFaker;
    private array $newData = [
        'name' => 'Sport News',
        'type' => 'multiple',
        'parent_id' => null,
    ];

    /**
     * @return void
     */
    public function testCategoryStoreCreate()
    {
        $this->post('/api/category', $this->newData)
            ->assertExactJson(['data' => [
                'id' => 1,
                'name' => 'Sport News',
                'type' => 'multiple',
                'parent_id' => null,
            ]]);
    }

    /**
     * @return void
     */
    public function testCategoryStoreFailedValidFirst()
    {
        $category = [
            'parent_id' => 'error',
        ];
        $this->postJson('/api/category', $category)
            ->assertJsonValidationErrors(['name', 'type', 'parent_id']);
    }

    /**
     * @return void
     */
    public function testCategoryStoreFailedValidSecond()
    {
        $category = [
            'name' => 111,
            'type' => 111,
            'parent_id' => [],
        ];
        $this->postJson('/api/category', $category)
            ->assertJsonValidationErrors(['name', 'type', 'parent_id']);
    }

    /**
     * @return void
     */
    public function testCategoryStoreFailedValidThird()
    {
        $category = [
            'name' => $this->faker->realTextBetween(201, 300),
            'type' => 'error',
            'parent_id' => 1,
        ];
        $this->postJson('/api/category', $category)
            ->assertJsonValidationErrors(['name', 'type', 'parent_id']);
    }
}
