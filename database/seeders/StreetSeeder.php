<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Street;
class StreetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Street::create([
            "id" => 1,
            "street_name" => "Post office #20 in the city of Mykolaiv."
        ]);
        Street::create([
            "id" => 2,
            "street_name" => "Post office #120 in the city of Kharkiv."
        ]);
        Street::create([
            "id" => 3,
            "street_name" => "Post office #2 in the city of Kharkiv."
        ]);
    }
}
