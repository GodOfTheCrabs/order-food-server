<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Food;
use App\Models\PriceUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Storage;
use Str;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foods = [];

        $categories = Category::all();

        for ($i=0; $i < 30; $i++) { 
            $category = $categories->random();

            $categoryImagePath = $category->image;

            $newImageName = Str::random(40) . '.jpg';

            $newImagePath = 'images/' . $newImageName;

            Storage::copy($categoryImagePath, $newImagePath);

            $foods[] = [
                'name' => Str::random(15),
                'price' => rand(0, 200),
                'category_id' => $category->id,
                'image' => $newImagePath,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        };

        Food::insert($foods);
    }
}
