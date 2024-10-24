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
use App\Http\Requests\OpenDealRequest;
use App\Services\DealService;
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

    public function edit(Lead $lead)
    {
        return view('leads.edit', compact("lead"));
    }

    public function update(Lead $lead, OpenDealRequest $request, DealService $dealService)
    {
        $deal = $dealService->openDeal($request->validated(), $lead);
        return redirect()->route("deal.edit", [$deal->id]);
    }

    public static function create()
    {
        return view("leads.create");
    }
}
