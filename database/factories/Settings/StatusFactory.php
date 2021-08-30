<?php

namespace Database\Factories\Settings;

use App\Models\Settings\Status;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class StatusFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Status::class;

    /**
     * @return array
     */
    #[ArrayShape(['name' => "string"])] public function definition(): array
    {
        return [
            'name' => $this->faker->word()
        ];
    }
}
