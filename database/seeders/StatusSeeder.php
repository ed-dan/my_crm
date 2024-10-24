<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            "id" => 1,
            "status" => "Confirm"
        ]);
        Status::create([
            "id" => 2,
            "status" => "Call Later"
        ]);
        Status::create([
            "id" => 3,
            "status" => "Too Expensive"
        ]);
        Status::create([
            "id" => 4,
            "status" => "Changed his mind"
        ]);
        Status::create([
            "id" => 5,
            "status" => "Disloyal Customer"
        ]);
    }
}
