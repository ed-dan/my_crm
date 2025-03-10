<?php

namespace Database\Seeders;

use App\Models\EmployeeLead;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::create([
            "id" => 1,
            "title" => "Admin"
        ]);
        Position::create([
            "id" => 2,
            "title" => "Analytical Expert"
        ]);
        Position::create([
            "id" => 3,
            "title" => "Manager"
        ]);
    }
}
