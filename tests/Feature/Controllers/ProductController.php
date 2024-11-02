<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\models\Category;
use App\models\Company;

class ProductController extends TestCase
{
    use RefreshDatabase;

    public function test_manager_cant_access_products_index_page() : void 
    {
        
    }

    public function test_create_new_product_success() : void 
    {
        $product = [
            'title' => "test product",
            'identifier' => 321321,
            'company_id' => Company::factory(),
            'category_id' => Category::factory(),
            'price' => 123,
        ];
    }
}
