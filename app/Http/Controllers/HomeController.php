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
            ->find(auth()->id())->position->id;

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
            "profit" => $profit->find(1)->deals_sum_amount ?? 0,
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
