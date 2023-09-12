<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provider>
 */
class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
//            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'birthday' => $this->faker->date('Y-m-d'),
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'gender' => $this->faker->randomElement(['M', 'F']),
            'photo' => $this->faker->imageUrl,
            'description' => $this->faker->realText
        ];
    }
}
