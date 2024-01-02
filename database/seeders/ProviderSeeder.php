<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Provider;
use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Provider::factory()->count(20)
            ->has(Order::factory(5)->hasOrderItems(3))
            ->hasComments(5)
            ->hasServices(3)
            ->hasCompany()
            ->create();
    }
}
