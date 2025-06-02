<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allFoods = Food::all();

        for ($i = 0; $i < 50; $i++) {
            $foodsForOrder = $allFoods->random(rand(2, 5))->map(function ($food) {
                $count = rand(1, 5);
                return [
                    'food_id' => $food->id,
                    'count' => $count,
                    'price' => $food->price,
                    'total' => $food->price * $count,
                ];
            });

            $totalPrice = $foodsForOrder->sum('total');

            $foods = $foodsForOrder->map(function ($item) {
                return [
                    'food_id' => $item['food_id'],
                    'count' => $item['count'],
                ];
            });

            $randomDate = Carbon::now()
                ->startOfMonth()
                ->addDays(rand(0, now()->daysInMonth - 1))
                ->setTime(rand(0, 23), rand(0, 59), rand(0, 59));

            Order::create([
                'user_id' => 3,
                'foods' => $foods,
                'total_price' => $totalPrice,
                'created_at' => $randomDate,
                'updated_at' => $randomDate,
            ]);
        }
    }
}
