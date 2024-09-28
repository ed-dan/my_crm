<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Deal;
use App\Models\Lead;
use App\Models\Position;
use App\Models\Stage;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{

    public function __construct(
//        private StoreTaskRequest $request,
//        private TaskService      $taskService,   ???
    )
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $direction = "desc";
        $employees = DB::table("users");
        $manager_id = auth()->id();
        if (request()->sort)
            $direction = request()->sort;
        date_default_timezone_set('Europe/Istanbul');
        $today = date("Y-m-d");
        $tasks = DB::table("tasks")
            ->join("users", "users.id", "=", "tasks.employee_id")
            ->join("deals", "deals.id", "=", "tasks.deal_id")
            ->orderBy("tasks.deadline", $direction);
        $tasks = $tasks->where("status_id", "=", 2);
        if (\request()->search)
            $tasks = $tasks->where("tasks.title", 'like', '%' . request('search') . '%');
        if (request()->only)
            $tasks->whereDate("tasks.deadline", request()->only, $today);
        if (\request()->employee) {
            $tasks = $tasks->where("deals.employee_id", "=", \request()->employee);
        }
        $position = Position::find(Auth::user()->position_id)->title;
        if ($position === "Manager") {
            $tasks->where("tasks.employee_id", "=", $manager_id);
            $employees = $employees->get();
        }
        if ($position === "Admin")
            $employees = $employees->where("users.id", "!=", $manager_id)->get();
        return view("tasks.index", [
            "tasks" => $tasks->get(),
            "position" => $position,
            "employees" => $employees,
        ]);
    }

    public function create($id)
    {
        $deal = Deal::find($id);
        return view("tasks.create", [
            "stages" => Stage::all(),
            "deal" => $deal,
            "lead" => Lead::where("id",$deal->lead_id)->get(),
        ]);
    }

    public function store(StoreTaskRequest $request, TaskService $taskService, $deal_id)
    {
        $taskService->store($request->validated(), $deal_id);
        return redirect()->route("task.success", $deal_id);
    }

    public function success($id)
    {
        $deal = Deal::find($id);
        $stages = DB::table("stages")->get();
        return view("tasks.success", ["deal" => $deal, "stages" => $stages]);
    }
}
