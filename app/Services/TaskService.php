<?php

namespace App\Services;

use App\Models\Deal;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TaskService
{
    public function store(array $taskData, Deal $deal): void
    {
        $callback_status = Status::where("status", "=", "Call later")->get();
        $employee = $deal->employee;
        if (!$employee->task_id)
            $employee->update(["task_id" => $employee->id]);

        $deal->update([
            "task_id" => $deal->id,
            "status_id" => $callback_status[0]->id
        ]);
        $taskData = $this->afterValidation($taskData, $deal);
        Task::create($taskData);
    }

    private function afterValidation(array $taskData, Deal $deal): array
    {
        $taskData["deadline"] = $taskData["deadline"] . " " . $taskData["time"];
        $taskData["deal_id"] = $deal->id;
        unset($taskData["time"]);
        return $taskData;
    }
}
