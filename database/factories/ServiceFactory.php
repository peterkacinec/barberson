<?php

namespace Database\Factories;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->title,
            'description' => $this->faker->realText,
            'price' => $this->faker->randomFloat('2','0','1000'),
            'duration' => $this->faker->randomElement([30,45,60,90]),
            'provider_id' => Provider::factory(),
        ];
    }
}
