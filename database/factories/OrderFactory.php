<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'date' => $this->faker->date('Y-m-d'),
            'price' => $this->faker->randomFloat('2','0','1000'),
            'currency' => $this->faker->randomElement(['EUR']),
            'status' => $this->faker->randomElement(['pending', "completed", "cancelled", "refunded"]),
            'payment_type' => $this->faker->randomElement(['card']),
            'provider_id' => Provider::factory(),
            'customer_id' => Customer::factory(),
            'customer_address' => $this->faker->address,
        ];
    }
}
