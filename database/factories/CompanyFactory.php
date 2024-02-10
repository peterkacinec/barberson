<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provider>
 */
class CompanyFactory extends Factory
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
            'title' => $this->faker->company,
            'ico' => $this->faker->randomNumber(),
            'vat' => $this->faker->randomNumber(),
            'iban' => $this->faker->iban(),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail(),
            'street' => $this->faker->streetAddress,
            'house_number' => $this->faker->buildingNumber,
            'city' => $this->faker->city,
            'zip' => $this->faker->postcode,
            'country' => $this->faker->country,
        ];
    }
}
