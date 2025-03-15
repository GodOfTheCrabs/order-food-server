<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\User;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $foods = Food::all();

        DB::table('comments')->insert([
            [
                'user_id' => $users->random()->id,
                'food_id' => $foods->random()->id,
                'comment' => 'Очень вкусно! Рекомендую.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $users->random()->id,
                'food_id' => $foods->random()->id,
                'comment' => 'Не очень понравилось, вкус слишком сильный.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $users->random()->id,
                'food_id' => $foods->random()->id,
                'comment' => 'Отличный выбор для обеда.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
