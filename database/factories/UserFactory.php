<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class UserFactory extends Factory
{
    /**
     * @var string
     */
    protected $model =User::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'login'=>$this->faker->userName(),
            'password'=>$this->faker->password(),
            'email'=>$this->faker->email(),
            'role_id'=>Role::factory(),
            'real_name'=>$this->faker->firstName(),
            'surname'=>$this->faker->lastName(),
        ];
    }
}
