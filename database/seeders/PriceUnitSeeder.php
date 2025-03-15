<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('price_units')->insert([
            ['name' => '100г'],
            ['name' => '150Г'],
            ['name' => '200г'],
            ['name' => "шт"],
        ]);
    }
}
