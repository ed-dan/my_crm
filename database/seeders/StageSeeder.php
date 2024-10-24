<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stage;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stage::create([
            "id" => 1,
            "title" => "Awareness"
        ]);
        Stage::create([
            "id" => 2,
            "title" => "Interest"
        ]);
        Stage::create([
            "id" => 3,
            "title" => "Decision"
        ]);
        Stage::create([
            "id" => 4,
            "title" => "Success"
        ]);
    }
}
