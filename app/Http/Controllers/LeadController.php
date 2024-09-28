<?php

namespace App\Http\Controllers;

use App\Imports\LeadsImport;
use App\Models\Deal;
use App\Models\Employee;
use App\Models\EmployeeLead;
use App\Models\Lead;
use App\Models\Position;
use App\Models\Product;
use App\Models\User;
use Database\Factories\LeadFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class LeadController extends Controller
{
    public function import()
    {
        ini_set("memory_limit", "-1");
        Excel::import(new LeadsImport(), 'testLeads.xlsx');
        return redirect('/')->with('success', 'All good!');
    }

    public static function index()
    {
        return view('leads.index', ['name' => 'leads', 'title' => 'leads',
            'leads' => Lead::sortable()->latest()->orderBy('source')->filter(request(['search']))
                ->paginate(10),
        ]);
    }

    public function edit($id)
    {
        $lead = Lead::find($id);
        $product = Product::find($lead->product_id);
        return view('leads.edit', ['lead' => $lead, 'product' => $product]);
    }

    public function createDeal(Lead $lead)
    {
        $manager_id = auth()->id();
        EmployeeLead::create([
            "employee_id" => $manager_id,
            "lead_id" => $lead->id
        ]);
        date_default_timezone_set('Europe/Istanbul');
        $date = date('Y-m-d h:i:s', time());
        $deal = Deal::create([
            "stage_id" => 1,
            "products" => $lead->product_id,
            "employee_id" => $manager_id,
            "lead_id" => $lead->id,
            "closing_date" => $date,
            "amount" => 0,
            "status_id" => 3
        ]);
        $formFields = \request()->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('employees', 'email')->ignore($lead->id)],
            'phone' => ['required', Rule::unique('employees', 'phone')->ignore($lead->id)],
        ]);
        $lead->update(["employee_id" => $manager_id]);
        $lead->update($formFields, [
        ]);
        return redirect()->route("deal.edit", [$deal->id]);
    }

    public static function create()
    {
        return view("leads.create");
    }
}
