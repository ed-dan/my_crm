<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Collection;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subject',
        'notes_id',
        'priority',
        'deadline',
        'deal_id',
        'employee_id',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, "employee_id", "task_id");
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal_id', 'task_id');
    }

    public function scopeWithFilter($query)
    {
        $today = date("Y-m-d");
        if (\request()->search)
            $query = $query->where("tasks.title", 'like', '%' . request('search') . '%');
        if (\request()->only)
            $query = $query->whereDate("tasks.deadline", request()->only, $today);
        if (\request()->employee)
            $query = $query->where("employee_id", "=", \request()->employee);
        if (\request()->sort)
            $query = $query->orderBy("tasks.deadline", request()->sort);
        return $query;
    }

    public function scopeWithPosition($query, $position_id)
    {
        return $position_id == User::MANAGER_ID ? $query->where("employee_id", "=", auth()->id()) : $query;
    }

    public function getCurrentTasks(Collection $tasks): Collection
    {
        $current_tasks = $tasks->filter( function ($item, $key) {
            return (explode(" ", $item->deadline)[0]) == date("Y-m-d");
        });

        return $current_tasks;
    }
}
