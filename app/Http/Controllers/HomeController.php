<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\DealEmployee;
use App\Models\EmployeeLead;
use App\Models\Lead;
use App\Models\Position;
use App\Models\Stage;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//use http\Client\Curl\User;

class HomeController extends Controller
{
//    private array $parameters = [];
//    private $value;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        private Lead $today_calls,
        private Deal $confirmed_deals,
        private Task $tasks
    )
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function homePage()
    {
        $position = User::with("position")
            ->where("id", auth()->id())->firstOrFail()->position->id;
        if ($position == User::ADMIN_ID)
            return $this->adminHome();
        if ($position == User::ANALYTIC_ID)
            return $this->analystHome();
        if ($position == User::MANAGER_ID)
            return $this->managerHome();
    }

    public function adminHome()
    {
        $deals_data = $this->tasks->with("deal")->get();
        $employees = User::where("position_id", "=", User::MANAGER_ID)->get();
        return view('home-pages.admin-home', [
            'tasks' => $this->tasks->getCurrentTasks($deals_data),
            'stages' => Stage::all(),
            'employees' => $employees,
            "deal_employee" => DealEmployee::all(),
            "employee_lead" => EmployeeLead::all(),
            'positions' => Position::all(),
            'confirmed_deals' => $this->confirmed_deals->CountSuccessDeals(),
            'today_calls' => $this->today_calls->has("employee_lead")->count(),
            'today_history' => $this->today_calls->orderBy("leads.updated_at", "desc")->get(),
        ]);
    }

    public function analystHome()
    {
        $deal_statistic = [];
        $statuses = Status::withCount(["deals" => function (Builder $query) {
            $query->withManager()->withPeriod(request()->period);
        }])->get();
        $profit = Status::withSum(["deals" => function (Builder $query) {
            $query->withManager()->withPeriod(request()->period);
        }], "amount")->get();

        foreach ($statuses as $status) {
            $deal_statistic[$status->status] = $status->deals_count;
        }
        $users = User::where("position_id", User::MANAGER_ID)->get();
        $capacity = array_sum($deal_statistic) ? intval(($deal_statistic["Confirm"] / array_sum($deal_statistic)) * 100) : 1;
        return view('home-pages.analyst-home', [
            "users" => $users,
            "profit" => $profit->find(1)->deals_sum_amount,
            "capacity" => $capacity,
            'deal_statistic' => $deal_statistic,
            'confirmed_deals' => $this->confirmed_deals->CountSuccessDeals(),
            'today_calls' => $this->today_calls->has("employee_lead")->count(),
            'today_history' => $this->today_calls->orderBy("leads.updated_at", "desc")->get(),
        ]);
    }

    public function managerHome()
    {
        $deals_data = $this->tasks->with("deal")->where("employee_id",  auth()->id())->get();
        $today_calls = $this->today_calls->whereHas("employee_lead", function (Builder $query) {
            $query->where('employee_id', auth()->id());
        });
        return view('home-pages.manager-home', [
            'tasks' => $this->tasks->getCurrentTasks($deals_data),
            'stages' => Stage::all(),
            'today_calls' => $today_calls->count(),
            'leads' => Lead::doesntHave("employee_lead")->get(),
            'today_history' => $today_calls->orderBy("leads.updated_at", "desc")->get(),
            'confirmed_deals' => $this->confirmed_deals->CountSuccessDeals(auth()->id())
        ]);
    }
}

//        date_default_timezone_set('Europe/Istanbul');
//        if (request()->manager)
//            $deals->where("employee_id", "=", request()->manager);
//        if (str_starts_with(request()->period, "d")) {
//            $deals->whereDay("closing_date", substr(request()->period, 1, 2));
//            $parameters["Reject deals"] = DB::table("deals")->where("employee_id", "=", request()->manager)
//                ->where("status_id", ">", "2")->whereDay("closing_date", substr(request()->period, 1, 2))->count();
//            $parameters["Callback deals"] = DB::table("deals")->where("employee_id", "=", request()->manager)
//                ->where("status_id", "=", "2")->whereDay("closing_date", substr(request()->period, 1, 2))->count();
//            $parameters["Confirm deals"] = DB::table("deals")->where("employee_id", "=", request()->manager)
//                ->where("status_id", "=", "1")->whereDay("closing_date", substr(request()->period, 1, 2))->count();
//        }
//        if ((request()->period == "0") and (request()->manager == "0") or
//            ((request()->period == null) and (request()->manager == null)
//                and (request()->period2 == null) and (request()->manager2 == null))) {
//            $parameters["Reject deals"] = DB::table("deals")
//                ->where("status_id", ">", "2")->whereYear("closing_date", "2024")->count();
//            $parameters["Callback deals"] = DB::table("deals")
//                ->where("status_id", "=", "2")->whereYear("closing_date", "2024")->count();
//            $parameters["Confirm deals"] = DB::table("deals")
//                ->where("status_id", "=", "1")->whereYear("closing_date", "2024")->count();
//        }
//        if (($parameters["Confirm deals"])) {
//            $test = ($parameters["Confirm deals"] * 100) / array_sum($parameters);
//        }
//        if (str_starts_with(request()->period2, "m")) {
//            $parameters = array();
//            $profit = DB::table("deals")
//                ->where("employee_id", "=", request()->manager2)
//                ->whereMonth("closing_date", substr(request()->period2, 1, 2))
//                ->sum("amount");
//            $products = DB::table("products")->select("title")->get();
//            foreach ($products as $product) {
//                $count = DB::table("deal_products")
//                    ->join("products", "products.id", "=", "deal_products.product_id")
//                    ->join("deals", "deals.id", "=", "deal_products.deal_id")
//                    ->whereMonth("closing_date", substr(request()->period2, 1, 2))
//                    ->where("employee_id", "=", request()->manager2)->where("title", "=", $product->title);
//                $parameters[$product->title] = count($count->get());
//            }
//        }
//        if (str_starts_with(request()->period2, "m")) {
//            $parameters = array();
//            $profit = DB::table("deals")
//                ->where("employee_id", "=", request()->manager2)
//                ->whereMonth("closing_date", substr(request()->period2, 1, 2))
//                ->sum("amount");
//            $products = DB::table("products")->select("title")->get();
//            foreach ($products as $product) {
//                $count = DB::table("deal_products")
//                    ->join("products", "products.id", "=", "deal_products.product_id")
//                    ->join("deals", "deals.id", "=", "deal_products.deal_id")
//                    ->whereMonth("closing_date", substr(request()->period2, 1, 2))
//                    ->where("employee_id", "=", request()->manager2)->where("title", "=", $product->title);
//                $parameters[$product->title] = count($count->get());
//            }
//        }
//        if (str_starts_with(request()->period2, "Y")) {
//            $parameters = array();
//            $profit = DB::table("deals")
//                ->where("employee_id", "=", request()->manager2)
//                ->whereYear("closing_date", substr(request()->period2, 1, 4))
//                ->sum("amount");
//            $products = DB::table("products")->select("title")->get();
//            foreach ($products as $product) {
//                $count = DB::table("deal_products")
//                    ->join("products", "products.id", "=", "deal_products.product_id")
//                    ->join("deals", "deals.id", "=", "deal_products.deal_id")
//                    ->whereYear("closing_date", substr(request()->period2, 1, 4))
//                    ->where("employee_id", "=", request()->manager2)->where("title", "=", $product->title);
//                $parameters[$product->title] = count($count->get());
//            }
//        }
//dd($parameters);
//        if (str_starts_with(request()->period, "m")) {
//            $deals->whereMonth("closing_date", substr(request()->period, 1, 2));
//            $parameters["Reject deals"] = DB::table("deals")->where("employee_id", "=", request()->manager)
//                ->where("status_id", ">", "2")->whereMonth("closing_date", substr(request()->period, 1, 2))->count();
//            $parameters["Callback deals"] = DB::table("deals")->where("employee_id", "=", request()->manager)
//                ->where("status_id", "=", "2")->whereMonth("closing_date", substr(request()->period, 1, 2))->count();
//            $parameters["Confirm deals"] = DB::table("deals")->where("employee_id", "=", request()->manager)
//                ->where("status_id", "=", "1")->whereMonth("closing_date", substr(request()->period, 1, 2))->count();
//        }
//        if (str_starts_with(request()->period, "Y")) {
//            $deals->whereYear("closing_date", substr(request()->period, 1, 4));
//            $parameters["Reject deals"] = DB::table("deals")->where("employee_id", "=", request()->manager)
//                ->where("status_id", ">", "2")->whereYear("closing_date", substr(request()->period, 1, 4))->count();
//            $parameters["Callback deals"] = DB::table("deals")->where("employee_id", "=", request()->manager)
//                ->where("status_id", "=", "2")->whereYear("closing_date", substr(request()->period, 1, 4))->count();
//            $parameters["Confirm deals"] = DB::table("deals")->where("employee_id", "=", request()->manager)
//                ->where("status_id", "=", "1")->whereYear("closing_date", substr(request()->period, 1, 4))->count();
//
//        }
//        if (str_starts_with(request()->period, "Y")) {
//            $deals->whereYear("closing_date", substr(request()->period, 1, 4));
//            $parameters["Reject deals"] = DB::table("deals")->where("employee_id", "=", request()->manager)
//                ->where("status_id", ">", "2")->whereYear("closing_date", substr(request()->period, 1, 4))->count();
//            $parameters["Callback deals"] = DB::table("deals")->where("employee_id", "=", request()->manager)
//                ->where("status_id", "=", "2")->whereYear("closing_date", substr(request()->period, 1, 4))->count();
//            $parameters["Confirm deals"] = DB::table("deals")->where("employee_id", "=", request()->manager)
//                ->where("status_id", "=", "1")->whereYear("closing_date", substr(request()->period, 1, 4))->count();
//
//        }
//            if (str_starts_with(request()->period2, "d"))
//                $profit = $profit->whereDay("closing_date", substr(request()->period2, 1, 2))->sum("amount");
//            if (str_starts_with(request()->period2, "m"))
//                $profit = $profit->whereMonth("closing_date", substr(request()->period2, 1, 2))->sum("amount");
//            if (str_starts_with(request()->period2, "Y"))
//                $profit = $profit->whereYear("closing_date", substr(request()->period2, 1, 4))->sum("amount");
