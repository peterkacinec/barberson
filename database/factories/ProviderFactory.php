<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\CustomerUser;
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
            'state' => $this->faker->randomElement(['new', 'todo']),
//            'photo' => $this->faker->imageUrl,
            'description' => $this->faker->realText,
            'company_id' => Company::factory(),
            'category_id' => $this->faker->randomElement([1,2,3,4,5]),
        ];
    }
}
