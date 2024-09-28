<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Lead extends Model
{
    use HasFactory;
    use Sortable;
    public array $sortable = ['name',];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_leads',
            'lead_id', 'employee_id');
    }

    public function deals()
    {
        return $this->hasMany(Deal::class, 'lead_id', 'id');
    }

    public function employee_lead()
    {
        return $this->hasOne(EmployeeLead::class, 'lead_id', 'id');
    }


}
