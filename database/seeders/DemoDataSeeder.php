<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;
use App\Models\Lead;
use App\Models\User;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PositionSeeder::class,
            StageSeeder::class,
            StatusSeeder::class,
            CategorySeeder::class,
            CompanySeeder::class,
            StreetSeeder::class,
            ProductSeeder::class
           ]);
        User::factory(1)->create();
        Lead::factory(5)->create();
    }
}
