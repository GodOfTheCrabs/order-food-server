<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call( [
            // CategorySeeder::class,
//            RoleSeeder::class,
            // PriceUnitSeeder::class
            // FoodSeeder::class
             OrderSeeder::class
            // CommentSeeder::class
            // RatingSeeder::class
        ]);
    }
}
