<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = DB::table("companies")->get();
        $products = DB::table("products")
            ->join("categories","categories.id", "=", "products.category_id")
            ->select("categories.title as category_title", "products.title", "products.company_id",)
            ->get();
        return view("companies.index", [
            "companies" => $companies,
            "products" => $products,
        ]);
    }

    public function create()
    {
        return view("companies.create");
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
        Company::create($formFields,["company_phone" => request()->company_phone]);
        return redirect('/companies');
    }

    public function show(Company $company)
    {
        return view("companies.show",["company" => $company]);
    }

}
