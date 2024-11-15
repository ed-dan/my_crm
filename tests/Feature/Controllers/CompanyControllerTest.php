<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Company;

class CompanyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_manager_cant_access_companies_index_page() : void 
    {
        $this->setFactoryData(User::MANAGER_ID);

        $response = $this->actingAs($this->user)->get('/companies');

        $response->assertStatus(403);
    }

    public function test_manager_cant_access_companies_create_page() : void 
    {
        $this->setFactoryData(User::MANAGER_ID);

        $response = $this->actingAs($this->user)->get('/companies/create');

        $response->assertStatus(403);
    }

    public function test_analytic_can_access_companies_index_page() : void 
    {
        $this->setFactoryData(User::ANALYTIC_ID);

        $response = $this->actingAs($this->user)->get('/companies');

        $response->assertStatus(200);
    }

    public function test_analytic_cant_access_companies_create_page() : void 
    {
        $this->setFactoryData(User::ANALYTIC_ID);

        $response = $this->actingAs($this->user)->get('/companies/create');

        $response->assertStatus(403);
    }

    public function test_admin_can_access_companies_index_page() : void 
    {
        $this->setFactoryData(User::ADMIN_ID);

        $response = $this->actingAs($this->user)->get('/companies');

        $response->assertStatus(200);
    }

    public function test_admin_can_access_companies_create_page() : void 
    {
        $this->setFactoryData(User::ADMIN_ID);

        $response = $this->actingAs($this->user)->get('/companies/create');

        $response->assertStatus(200);
    }

    public function test_admin_can_see_companies_company_button() : void 
    {
        $this->setFactoryData(position_id: User::ADMIN_ID);

        $response = $this->actingAs($this->user)->get('/companies');

        $response->assertStatus(200);
        $response->assertSee('Add new Company');
    }

    public function test_analytic_cant_see_companies_company_button() : void 
    {
        $this->setFactoryData(User::ANALYTIC_ID);

        $response = $this->actingAs($this->user)->get('/companies');

        $response->assertStatus(200);
        $response->assertDontSee('Add new Company');
    }

    public function test_create_new_company_success() : void 
    {
        $this->setFactoryData(User::ADMIN_ID);
        $company = [
            'name' => 'test company',
            'company_phone' => '+380669338666',
        ]; 

        $response = $this->actingAs($this->user)->post('/companies', $company);

        $response->assertStatus(302);
        $response->assertRedirect('companies');
        $this->assertDatabaseHas('companies', $company);
        $lastCompany = Company::latest()->first();
        $this->assertEquals($company['name'], $lastCompany->name);
    }

    public function test_company_edit_contains_correct_values() : void 
    {
        $this->setFactoryData(User::ADMIN_ID);
        $company = Company::factory()->create();

        $response = $this->actingAs($this->user)->get('companies/'. $company->id . '/edit');

        $response->assertStatus(200);
        $response->assertSee('value="' . $company->name . '"', false);
        $response->assertSee('value="' . $company->company_phone . '"', false);
        $response->assertViewHas('company', $company);
       
    }

    public function test_company_show_contains_correct_values() : void 
    {
        $this->setFactoryData(User::ADMIN_ID);
        $company = Company::factory()->create();

        $response = $this->actingAs($this->user)->get('companies/'. $company->id);

        $response->assertStatus(200);
        $response->assertSee('value="' . $company->name . '"', false);
        $response->assertSee('value="' . $company->company_phone . '"', false);
        $response->assertViewHas('company', $company);
       
    }
    
    public function test_company_update_validation_error_redirects_back_to_form() : void 
    {
        $this->setFactoryData(User::ADMIN_ID);
        $company = Company::factory()->create();

        $response = $this->actingAs($this->user)->patch('companies/'. $company->id, [
            'name' => '',
            'company_phone' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'company_phone',]);
    }

    public function test_company_delete_success() : void 
    {
        $this->setFactoryData(User::ADMIN_ID);
        $company = Company::factory()->create();

        $response = $this->actingAs($this->user)->delete('companies/'. $company->id);

        $response->assertRedirect('companies');
        $this->assertDatabaseMissing('companies', $company->toArray());
        $this->assertDatabaseCount('companies', 0);
    }
}
