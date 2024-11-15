<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
{
    public function index()
    {
        return view('companies.index', [
            "companies" => Company::all(),
        ]);
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(StoreCompanyRequest $request)
    {
        Company::create($request->validated());
        return redirect('/companies');
    }

    public function show(Company $company)
    {
        return view('companies.show',['company' => $company]);
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Company $company, UpdateCompanyRequest $request)
    {   
        $company->update($request->validated());
        return redirect()->route('company.show', $company->id);
    }

    public function destroy(Company $company) 
    {
        $company->delete();
        
        return redirect()->route('company.index');
    }
}
