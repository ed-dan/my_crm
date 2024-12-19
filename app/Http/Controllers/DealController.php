<?php

namespace App\Http\Controllers;

use App\Models\{Deal, DealEmployee, DealProduct, Lead, Task, Position, Product, Stage, Street, User};
use Illuminate\Http\Request;
use App\Http\Requests\UpdateDealRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades;
use App\Services\DealService;
use Redis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class DealController extends Controller
{
    public function __construct()
    {
    }

    public function autocomplete(Request $request)
    {
        $data = Street::select("street_name as value", "id")
            ->where('street_name', 'LIKE', '%' . $request->get('search') . '%')
            ->limit(5)
            ->get();
        return response()->json($data);
    }

    public function index(): View
    {
        return view("deals.index", [
            'position' => auth()->user()->position->title,
            'deals' => Deal::with("lead", "stage", "products")->withQueryString(request())->simplePaginate(8),
            'employees' => User::where("position_id", User::MANAGER_ID)->get(),
            'products' => DB::table("products")->get(),
            'stages' => DB::table("stages")->get(),
        ]);
    }

    public function edit(Deal $deal): View
    {   
        return view('deals.edit', [
            'deal' => $deal,
            'products' => $deal->lead->getSimilarProducts(),
            "stages" => DB::table("stages")->get()
        ]);
    }

    //add data to the session 
    public function update(Deal $deal, UpdateDealRequest $request, DealService $dealService): RedirectResponse
    {      
        $dealService->update($deal, $request);
        return redirect()->route("deal.confirm", $deal->id);
    }
    
    //in prepareDeal() we obtain data from session() and display in form 
    public function confirm(Deal $deal, DealService $dealService): View
    {
        $dealService->prepareDeal();
        return view('deals.confirm', [
            'deal' => $deal,
            "stages" => DB::table("stages")->get(),
            'product_names' => session()->get("product_list"),
            "amount" => session()->get("amount"),
        ]);
    }
    
    //update deal_product table and crear data from sesiom
    public function closeDeal(Deal $deal, DealService $dealService): View
    {
        $dealService->closeDeal($deal);
        return view('deals.close-deal');
    }

    public function rejectDeal(Deal $deal): View
    {
        return view("deals.reject", [
            "deal" => $deal,
            "stages" => DB::table("stages")->get()
        ]);
    }

    public function rejectAndClose(Deal $deal, DealService $dealService): RedirectResponse
    {
        $dealService->reject($deal);
        return redirect()->route("home");
    }

    public function aboutDeal(Deal $deal, Redis $redis): View
    {
        return view("deals.about", [
            "deal" => $deal,
            "user" => $deal->employee,
            "task_deadline" => $deal->tasks->last()->deadline ?? null,
            "stages" => DB::table("stages")->get(),
            "product_list" => $deal->getProductList(),
            "categories" => DB::table("categories")->get(),
            "companies" => DB::table("companies")->get()
        ]);
    }
}

