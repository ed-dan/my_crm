<?php

namespace App\Services;

use App\Models\Deal;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TaskService
{
    public function store(array $taskData, int $deal_id): void
    {
        DB::transaction(function () use ($taskData, $deal_id) {
            $callback_status = Status::where("status", "=", "Call later")->get();
            $employee = auth()->user();
            if (!$employee->task_id)
                $employee->update(["task_id" => $employee->id]);

            Deal::find($deal_id)->update([
                "task_id" => $deal_id,
                "status_id" => $callback_status[0]->id
            ]);

            $taskData = $this->afterValidation($taskData, $deal_id);
            Task::create($taskData);
        });
    }

    private function afterValidation(array $taskData, int $deal_id): array
    {
        $taskData["deadline"] = $taskData["deadline"] . " " . $taskData["time"];
        $taskData["deal_id"] = $deal_id;
        unset($taskData["time"]);
        return $taskData;
    }
}
