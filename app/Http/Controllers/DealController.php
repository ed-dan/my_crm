<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\DealEmployee;
use App\Models\DealProduct;
use App\Models\Lead;
use App\Models\Position;
use App\Models\Product;
use App\Models\Stage;
use App\Models\Street;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DealController extends Controller
{
    public function __construct()
    {

    }

    public function reg()
    {
        return view('reg', ['positions' => Position::all()]);
    }

    public function autocomplete(Request $request)
    {
        $data = Street::select("street_name as value", "id")
            ->where('street_name', 'LIKE', '%' . $request->get('search') . '%')
            ->limit(5)
            ->get();
        return response()->json($data);
    }

    public function edit($id)
    {
        $deal = Deal::find($id);
        $stages = DB::table("stages")->get();
        $deal->update([
            'stage_id' => 2
        ]);
        $product = Product::find($deal->products);
        $products = DB::table("products")
            ->where("category_id", "=", $product->category_id)
            ->get();
        return view('deals.edit', [
            'deal' => $deal,
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

    public function confirm($id)
    {
        $deal = Deal::find($id);
        $lead = Lead::find($deal->lead_id);
        $stages = DB::table("stages")->get();
        $products_list = explode(" ", $deal->products);
        $product_names = "";
        $deal_amount = array();
        if (end($products_list) == "")
            array_pop($products_list);
        foreach ($products_list as $item) {
            $product_params = explode("*", $item);
            $product = DB::table("products")
                ->where("id", "=", $product_params[0])
                ->get();
            $temp_amount = $product[0]->price * $product_params[1];
            $deal_amount[] = $temp_amount;
            DealProduct::create([
                "deal_id" => $id,
                "product_id" => $product[0]->id
            ]);
            $product_names .= $product_params[1] . "x " . $product[0]->title . " - " . $temp_amount . " $,\n";
        }
        $deal->update([
            "amount" => array_sum($deal_amount),
        ]);
        return view('deals.confirm', [
            'deal' => $deal,
            "stages" => $stages,
            'product_names' => ltrim($product_names),
            'lead' => $lead
        ]);
    }

    public function closeDeal($deal)
    {
        $manager_id = Auth::user()->getAuthIdentifier();
        DealEmployee::create([
            "employee_id" => $manager_id,
            "deal_id" => Deal::find($deal)->id
        ]);
        $status = Deal::find($deal);
        $status->update([
            "status_id" => 1,
            "stage_id" => 4
        ]);
        return view('deals.close-deal');
    }

    public function rejectDeal($id)
    {
        $deal = Deal::find($id);
        $stages = DB::table("stages")->get();
        return view("deals.reject", ['deal' => $deal, "stages" => $stages]);
    }

    public function rejectAndClose(Deal $deal)
    {
        $formFields = \request()->validate([
            'status' => ['required'],
        ]);
        $deal->update([
            "status_id" => $formFields['status']
        ]);
        return redirect()->route("home");
    }

    public function index()
    {
        $direction = "desc";
        $sort_by = "closing_date";
        $manager_id = Auth::user()->getAuthIdentifier();
        $employees = DB::table("users");
        $products = DB::table("products")->get();
        $stages = DB::table("stages")->get();
        if (\request()->direction)
            $direction = \request()->direction;
        if (\request()->sort)
            $sort_by = \request()->sort;
        $leads = Lead::sortable()->latest()->filter(request(['search']))->paginate(10);
        $deals = DB::table("deals")
            ->join("leads", "leads.id", "=", "deals.lead_id")
            ->join("stages", "stages.id", "=", "deals.stage_id")
            ->select("deals.*", "leads.name", "leads.phone", "stages.title",)
            ->orderBy('deals.' . $sort_by, $direction);
        $position = Position::find(Auth::user()->position_id)->title;
        if ($position === "Manager") {
            $deals->where("deals.employee_id", "=", $manager_id);
            $employees = $employees->get();
        }
        if ($position === "Admin" or $position === "Analytical expert")
            $employees = $employees->where("users.id", "!=", $manager_id)->get();
        if (\request()->status) {
            $deal_query = $deals->where(\request()->status, 'like', '%' . request('search') . '%')
                ->paginate(8);

        } elseif (\request()->employee) {
            $deal_query = $deals->where("deals.employee_id", "=", \request()->employee)->paginate(8);

        } else {
            $deal_query = $deals->paginate(8);
        }
        return view("deals.index", [
            'position' => $position,
            'deals' => $deal_query,
            'employees' => $employees,
            'products' => $products,
            'stages' => $stages,
            'leads' => $leads
        ]);
    }

    public function aboutDeal($id)
    {
        $product_list = "";
        $deal = DB::table("deals")
            ->join("leads", "leads.id", "=", "deals.lead_id")
            ->join("stages", "stages.id", "=", "deals.stage_id")
            ->join("users", "users.id", "=", "deals.employee_id")
            ->join("statuses", "statuses.id", "=", "deals.status_id")
            ->select("deals.*", "stages.title as stage_title", "users.name as  user_name",
                "users.email as user_email", "users.id as user_id", "leads.name", "leads.phone",
                "leads.id as lead_id", "leads.email", "leads.source", "leads.created_at as lead_created_at",
                "statuses.id as status_id", "statuses.status")
            ->where("deals.id", "=", $id)
            ->get();
        if ($deal[0]->task_id != 0) {
            $task_deadline = DB::table("tasks")
                ->where("tasks.deal_id", "=", $deal[0]->id)
                ->select("tasks.deadline")
                ->get();
        }
        $products = DB::table("deal_products")
            ->where("deal_products.deal_id", "=", $id)
            ->join("products", "products.id", "=", "deal_products.product_id")
            ->get();
        foreach ($products as $product) {
            $product_list .= $product->title . ", ";
        }
        $user = User::find(Auth::user()->getAuthIdentifier());
        $categories = DB::table("categories")->get();
        $companies = DB::table("companies")->get();
        $stages = DB::table("stages")->get();
        return view("deals.about", [
            "user" => $user,
            "deal" => $deal[0],
            "task_deadline" => $task_deadline ?? null,
            "stages" => $stages,
            "products" => $products,
            "product_list" => $product_list,
            "categories" => $categories,
            "companies" => $companies
        ]);
    }
}

//        switch (intval(\request()->status)) {
//            case 2:
//                Deal::searcher('city', $deals, $employees, $products, $stages, $leads);
//                break;
//            case 3:
//                Deal::searcher('name', $deals, $employees, $products, $stages, $leads);
//                break;
//            case 4:
//                Deal::searcher('title', $deals, $employees, $products, $stages, $leads);
//                break;
//        }
//$deals->where('city', 'like', '%' . request('search') . '%')
//return view('employees.index', [ 'name' => '/', 'title' => 'employees',
//    'employees' => Employee::sortable()->latest()->orderBy('name')->filter(request([ 'search']))
//        ->paginate(10),
//    'positions' => Position::all()
//]);
//    public function editProduct()
//    {
//        $deals_data = DB::table("tasks")
//            ->join("deals", "deals.task_id", "=", "tasks.deal_id")
//            ->get();
//
//        return view('deals.edit-product', [
//            "products" => Product::all()
//        ]);
//    }
//    public function autocomplete2(Request $request)
//    {
//        $data = City::select("name as value", "id")
//            ->where('name', 'LIKE', '%'.$request->get('street'). '%')
//            ->limit(5)
//            ->get();
//        return response()->json($data);
//    }
//->join("stages", "stages.id", "=", "deals.stage_id")
