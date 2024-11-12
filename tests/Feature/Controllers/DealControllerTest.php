<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Deal;
use App\Models\User;
use Tests\TestCase;
use App\Models\Product;
use Database\Seeders\DemoDataSeeder;

class DealControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_paginated_deals_doesnt_contain_9th_record() : void
    {
        $this->setFactoryData(User::ADMIN_ID);

        $product = Product::factory()->create();
        $deals = Deal::factory(9)->create([
            'employee_id' => $this->user->id,
        ]);
        
        $lastDeal = $deals->last();

        $response = $this->actingAs($this->user)->get('/deals');

        $response->assertStatus(200);
        $response->assertViewHas('deals', function($collection) use ($lastDeal) {
            return !$collection->contains($lastDeal);
        });
    }

}
