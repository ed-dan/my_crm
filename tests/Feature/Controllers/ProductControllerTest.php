<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use App\Models\User;
use App\Models\Position;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    // #[Override]
    // protected function setFactoryData(int $position_id) : void 
    // {
    //     parent::setFactoryData($position_id);
    // }

    public function test_manager_cant_access_products_index_page() : void 
    {
        $this->setFactoryData(User::MANAGER_ID);

        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(403);
    }

    public function test_manager_cant_access_products_create_page() : void 
    {
        $this->setFactoryData(User::MANAGER_ID);

        $response = $this->actingAs($this->user)->get('/products/create');

        $response->assertStatus(403);
    }

    public function test_analytic_can_access_products_index_page() : void 
    {
        $this->setFactoryData(User::ANALYTIC_ID);

        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);
    }

    public function test_analytic_cant_access_products_create_page() : void 
    {
        $this->setFactoryData(User::ANALYTIC_ID);

        $response = $this->actingAs($this->user)->get('/products/create');

        $response->assertStatus(403);
    }

    public function test_admin_can_access_products_index_page() : void 
    {
        $this->setFactoryData(User::ADMIN_ID);

        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);
    }

    public function test_admin_can_access_products_create_page() : void 
    {
        $this->setFactoryData(User::ADMIN_ID);

        $response = $this->actingAs($this->user)->get('/products/create');

        $response->assertStatus(200);
    }

    public function test_admin_can_see_create_product_button() : void 
    {
        $this->setFactoryData(User::ADMIN_ID);

        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);
        $response->assertSee('Add new Product');
    }

    public function test_analytic_cant_see_create_product_button() : void 
    {
        $this->setFactoryData(User::ANALYTIC_ID);

        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);
        $response->assertDontSee('Add new Product');
    }

    public function test_create_new_product_success() : void 
    {
        $this->setFactoryData(User::ADMIN_ID);
        $company = Company::factory()->create();
        $category = Category::factory()->create();
        $product = [
            'title' => 'test product',
            'identifier' => 321321,
            'company_id' => $company->id,
            'category_id' => $category->id,
            'price' => 123,
        ]; 

        $response = $this->actingAs($this->user)->post('/products', $product);

        $response->assertStatus(302);
        $response->assertRedirect('products');
        $this->assertDatabaseHas('products', $product);
        $lastProduct = Product::latest()->first();
        $this->assertEquals($product['identifier'], $lastProduct->identifier);
    }

    public function test_product_edit_contains_correct_values() : void 
    {
        $this->setFactoryData(User::ADMIN_ID);
        $product = Product::factory()->create();

        $response = $this->actingAs($this->user)->get('products/'. $product->id . '/edit');

        $response->assertStatus(200);
        $response->assertSee('value="' . $product->price . '"', false);
        $response->assertSee('value="' . $product->identifier . '"', false);
        $response->assertSee('value="' . $product->title . '"', false);
        $response->assertViewHas('product', $product);
       
    }

    public function test_product_show_contains_correct_values() : void 
    {
        $this->setFactoryData(User::ADMIN_ID);
        $product = Product::factory()->create();

        $response = $this->actingAs($this->user)->get('products/'. $product->id);

        $response->assertStatus(200);
        $response->assertSee('value="' . $product->price . '.00 $"', false);
        $response->assertSee('value="id: ' . $product->identifier . '"', false);
        $response->assertSee('value="' . $product->title . '"', false);
        $response->assertViewHas('product', $product);
       
    }
    
    public function test_product_update_validation_error_redirects_back_to_form() : void 
    {
        $this->setFactoryData(User::ADMIN_ID);
        $product = Product::factory()->create();

        $response = $this->actingAs($this->user)->patch('products/'. $product->id, [
            'title' => '',
            'identifier' => '',
            'company_id' => '',
            'category_id' => '',
            'price' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['title', 'identifier', 'company_id', 'category_id', 'price']);
    }

    public function test_product_delete_success() : void 
    {
        $this->setFactoryData(User::ADMIN_ID);
        $product = Product::factory()->create();

        $response = $this->actingAs($this->user)->delete('products/'. $product->id);

        $response->assertRedirect('products');
        $this->assertDatabaseMissing('products', $product->toArray());
        $this->assertDatabaseCount('products', 0);
    }
}
