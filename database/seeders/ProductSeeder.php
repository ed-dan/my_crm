<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            "id" => 1,
            "title" => "Bn 1N5408  1000V ",
            "identifier" => "1231321",
            "company_id" => 1,
            "category_id" => 1,
            "price" => 205
        ]);
        Product::create([
            "id" => 2,
            "title" => "Resistor 1x32p kOhm ",
            "identifier" => "3213128",
            "company_id" => 1,
            "category_id" => 1,
            "price" => 99
        ]);
        Product::create([
            "id" => 3,
            "title" => "Extruded polystyrene foam",
            "identifier" => "432123",
            "company_id" => 2,
            "category_id" => 2,
            "price" => 119
        ]);
        Product::create([
            "id" => 4,
            "title" => "POLIMIN plaster SC-2",
            "identifier" => "4321223",
            "company_id" => 2,
            "category_id" => 2,
            "price" => 110
        ]);
        Product::create([
            "id" => 5,
            "title" => "Primer CERESIT ST-17",
            "identifier" => "5550000",
            "company_id" => 3,
            "category_id" => 2,
            "price" => 55
        ]);
        Product::create([
            "id" => 6,
            "title" => "UNI-T Megaohmmeter",
            "identifier" => "777777",
            "company_id" => 2,
            "category_id" => 1,
            "price" => 15
        ]);
    }
}
