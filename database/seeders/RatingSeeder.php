<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i=0; $i < 10; $i++) { 
            DB::table('ratings')->insert([
                [
                    'user_id' => 1,
                    'food_id' => 42,
                    'rating' => rand(1, max: 5),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        };

    }
}