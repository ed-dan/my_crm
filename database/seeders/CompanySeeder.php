<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            "id" => 1,
            "name" => "BigBob Technologies",
            "company_phone" => "(555) 123-4567"
        ]);
        Company::create([
            "id" => 2,
            "name" => "SmallMike Building",
            "company_phone" => "020 1234 5678"
        ]);
        Company::create([
            "id" => 3,
            "name" => "Build ATM Corporation",
            "company_phone" => "03-1234-5678"
        ]);
        Company::create([
            "id" => 4,
            "name" => "CanadaAudio Corporation",
            "company_phone" => "1-800-622-6232"
        ]);
    }
}
