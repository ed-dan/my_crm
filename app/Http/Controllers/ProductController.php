<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table("products")
            ->join("companies", "companies.id", "=", "products.company_id")
            ->join("categories", "categories.id", "=", "products.category_id")
            ->select("products.*", "categories.title as category_title", "companies.name as company_title")->get();
        return view("products.index", ["products" => $products]);
    }

    public function create()
    {
        $categories = DB::table("categories")->get();
        $companies = DB::table("companies")->get();
        return view("products.create", [
            "categories" => $categories,
            "companies" => $companies,
        ]);
    }

    public function store()
    {
        $formFields = \request()->validate([
            'name' => '',
            'address' => '',
            'website' => '',
            "company_phone  " => "",
            "description" => ""
        ]);
        Product::create($formFields,["company_phone" => request()->company_phone]);
        return redirect('/products');
    }
}
