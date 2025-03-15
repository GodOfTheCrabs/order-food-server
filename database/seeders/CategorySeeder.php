<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Овочі, фрукти'],
            ['name' => "М'ясо, ковбаса"],
            ['name' => 'Кулінарія, готові страви'],
            ['name' => 'Алкогольні напої'],
            ['name' => 'Риба, морепродукти'],
            ['name' => 'Вода, Соки, Напої'],
            ['name' => 'Хліб, пекарня'],
            ['name' => 'Солодощі'],
            ['name' => 'Снеки'],
        ]);
    }
}
