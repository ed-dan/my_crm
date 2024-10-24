<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\DealEmployee;
use App\Models\DealProduct;
use App\Models\Lead;
use App\Models\Task;
use App\Models\Position;
use App\Models\Product;
use App\Models\Stage;
use App\Models\Street;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateDealRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\DealService;

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

    public function index()
    {
        return view("deals.index", [
            'position' => auth()->user()->position->title,
            'deals' => Deal::with("lead", "stage", "products")->withQueryString(request())->simplePaginate(8),
            'employees' => User::where("position_id", User::MANAGER_ID)->get(),
            'products' => DB::table("products")->get(),
            'stages' => DB::table("stages")->get(),
        ]);
    }


    public function edit(Deal $deal)
    {   
        return view('deals.edit', [
            'deal' => $deal,
            'products' => $deal->lead->getSimilarProducts(),
            "stages" => DB::table("stages")->get()
        ]);
    }

    public function update(Deal $deal, UpdateDealRequest $request, DealService $dealService)
    {       
        $dealService->update($deal, $request);
            'product' => $product,
            'products' => $products,
            "stages" => $stages
        ]);
    }

    public function update(Deal $deal)
    {
        $stages = DB::table("stages")->get();
        $formFields = \request()->validate([
            'city' => ['required'],
            'address' => ['required'],
            "products" => ""
        ]);
        
        $counter = 0;
        $keys = array();
        $values = array();
        $str = "";
        while ($counter != count(\request()->request->all())) {
            if (\request()->request->get("id" . $counter)) {
                array_push($keys, \request()->request->get("id" . $counter));
            }
            if (\request()->request->get("count" . $counter)) {
                array_push($values, \request()->request->get("count" . $counter));
            }
            $end_keys = end($keys);
            $end_values = end($values);
            if ($end_keys and $end_values) {
                $str .= $end_keys . "*" . $end_values . ",";
            }
            $counter++;
        }
        $unique = array_unique(explode(",", $str));
        array_pop($unique);
        $unique = implode(" ", $unique);
        if (count($formFields) > 2) {
            $arr = $deal->products . "*" . $formFields['products'] . " " . $unique;
        }
        $deal->update([
            "stage_id" => 3,
            "city" => $formFields['city'],
            "address" => $formFields['address'],
            "products" => $arr,
        ]);
        return redirect()->route("deal.show", $deal->id);
    }

    public function confirm(Deal $deal, DealService $dealService)
    {
        $dealService->confirm($deal);
        return view('deals.confirm', [
            'deal' => $deal,
            "stages" => DB::table("stages")->get(),
            'product_names' => $deal->getProductList(),
        ]);
    }

    public function closeDeal(Deal $deal, DealService $dealService)
    {
        $dealService->closeDeal($deal);
        return view('deals.close-deal');
    }

    public function rejectDeal(Deal $deal)
    {
        return view("deals.reject", [
            "deal" => $deal,
            "stages" => DB::table("stages")->get()
        ]);
    }

    public function rejectAndClose(Deal $deal, DealService $dealService)
    {
        $dealService->reject($deal);
        return redirect()->route("home");
    }

    public function aboutDeal(Deal $deal)
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

