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
    public function __construct()
    {
        
    }

    public function index()
    {
        $position_id = auth()->user()->position_id;

        $tasks = Task::withWhereHas("deal", function ($query) {
            $query->where("status_id", "=", 2);
        })->with("employee")->WithFilter()->WithPosition($position_id);

        return view("tasks.index", [
            "tasks" => $tasks->get(),
            "position" => Position::find($position_id)->title,
            "employees" => User::where("position_id", "=", User::MANAGER_ID)->get(),
        ]);
    }

    public function create(Deal $deal)
    {
        return view("tasks.create", [
            "stages" => Stage::all(),
            "deal" => $deal,
            "lead" => Lead::where("id", $deal->lead_id)->get(),
        ]);
    }

    public function store(StoreTaskRequest $request, TaskService $taskService, Deal $deal)
    {
        $taskService->store($request->validated(), $deal);
        return redirect()->route("task.success", $deal);
    }

    public function success(Deal $deal)
    {
        return view("tasks.success", [
            "deal" => $deal,
            "stages" => DB::table("stages")->get()
        ]);
    }
}
