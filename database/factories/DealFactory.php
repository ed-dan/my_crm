<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Stage;
use App\Models\Status;
use App\Models\Lead;
use App\Models\User;
use App\Models\DealEmployee;
use App\Models\Deal;
class DealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "stage_id" => Stage::factory(),
            "status_id" => Status::factory(),
            "employee_id" => 1,
            "lead_id" => Lead::factory(),
            "closing_date" => "2024-10-25 08:24:20"
        ];
    }

    public function configure()
    {
    return $this->afterCreating(function (Deal $deal) {
        
        DealEmployee::create([
            "deal_id" => $deal->id,
            "employee_id" => $deal->employee_id,
        ]);
    });
    }
}
