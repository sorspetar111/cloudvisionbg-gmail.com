<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'name' => 'Basic',
            'description' => 'Basic weather forecast subscription',
            'price' => 9.99,
            'features' => json_encode(['Daily forecasts', 'Email notifications']),
            'is_active' => true,
        ]);

        Plan::create([
            'name' => 'Premium',
            'description' => 'Premium weather forecast subscription with advanced features',
            'price' => 19.99,
            'features' => json_encode([
                'Daily forecasts',
                'Email notifications',
                'Hourly updates',
                'Extended 10-day forecast',
                'Severe weather alerts'
            ]),
            'is_active' => true,
        ]);
    }
}