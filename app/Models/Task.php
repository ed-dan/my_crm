<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    //use SoftDeletes;

    public function employee()
    {
        return $this->belongsTo(Employee::class, "employee_id", "task_id");
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal_id', 'task_id');
    }

    public function getCurrentTasks($tasks): array
    {
        $current_tasks = array();
        foreach ($tasks as $task) {
            $current_day = explode(" ", $task->deadline);
            $current_day = substr($current_day[0], -2);
            if (intval($current_day) == intval(date("d")))
                $current_tasks[] = $task;
        }
        return $current_tasks;
    }
}
