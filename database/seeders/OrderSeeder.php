<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'user_id' => 1,
            'foods' => [
                ['food_id' => 40, 'count' => 3],
                ['food_id' => 41, 'count' => 2],
                ['food_id' => 42, 'count' => 4],
            ],
            'total_price' => 800,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
