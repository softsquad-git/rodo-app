<?php

namespace Database\Factories\Users;

use App\Helpers\Role;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use JetBrains\PhpStorm\ArrayShape;

class UserFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = User::class;

    /**
     * @return array
     */
    #[ArrayShape(['first_name' => "string", 'last_name' => "string", 'email' => "mixed", 'password' => "string", 'avatar_img' => "string", 'role' => "mixed|string", 'is_active' => "int"])] public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('start123'),
            'avatar_img' => '',
            'role' => Role::$role['ADMIN'],
            'is_active' => 1
        ];
    }
}
