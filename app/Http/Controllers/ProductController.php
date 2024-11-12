<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table("products")
            ->join("companies", "companies.id", "=", "products.company_id")
            ->join("categories", "categories.id", "=", "products.category_id")
            ->select("products.*", "categories.title as category_title", "companies.name as company_title")->get();
        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        $categories = DB::table('categories')->get();
        $companies = DB::table('companies')->get();
        return view('products.create', [
            'categories' => $categories,
            'companies' => $companies,
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        Product::create($request->validated());
        return redirect()->route('product.index');
    }

    public function show(Product $product)
    {
        $categories = DB::table('categories')->get();
        $companies = DB::table('companies')->get();
        return view('products.show', compact('product', 'categories', 'companies'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $companies = Company::all();
        return view('products.edit', compact('product', 'categories', 'companies'));
    }

    public function update(Product $product, UpdateProductRequest $request)
    {   
        $product->update($request->validated());
        return redirect()->route('product.show', $product->id);
    }

    public function destroy(Product $product) 
    {
        $product->delete();
        
        return redirect()->route('product.index');
    }
    
}
