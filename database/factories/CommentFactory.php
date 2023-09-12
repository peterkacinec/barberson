<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text' => $this->faker->realText,
            'rating' => $this->faker->numberBetween(1,5),
            'customer_id' => Customer::factory(),
            'provider_id' => Provider::factory(),
        ];
    }
}
