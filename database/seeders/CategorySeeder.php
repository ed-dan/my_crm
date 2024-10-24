<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            "id" => 1,
            "title" => "Technologies"
        ]);
        Category::create([
            "id" => 2,
            "title" => "Building Materials"
        ]);
        Category::create([
            "id" => 3,
            "title" => "Audio equipment"
        ]);
        Category::create([
            "id" => 4,
            "title" => "Vitamins and supplements"
        ]);
    }
}
