<?php

namespace Database\Factories;

use App\Models\CustomerUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
//            'id' => $this->faker->id(),
            'state' => $this->faker->randomElement(['new', 'todo']),
            'photo' => $this->faker->imageUrl,
            'c_user_id' => CustomerUser::factory(),
            'company_id' => null,
        ];
    }
}
