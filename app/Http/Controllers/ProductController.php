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
        return view('products.index', [
            'products' => Product::with('company', 'category')->get()
        ]);
    }

    public function create()
    {
        return view('products.create', [
            'categories' => Category::all(),
            'companies' => Company::all(),
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        Product::create($request->validated());
        return redirect()->route('product.index');
    }

    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product,
            'categories' => Category::all(),
            'companies' => Company::all(),
        ]);
    }

    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product,
            'categories' => Category::all(),
            'companies' => Company::all(),
        ]);
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
