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
    protected $fillable = [
        'name',
        'email',
        'phone',
        'source',
        'employee_id'
    ];

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


    public function getSimilarProducts()
    {
        return Product::where("category_id", $this->products->first()->category_id)->get();
    }

    public function products() 
    {
        return $this->belongsToMany(Product::class, "lead_products", "lead_id", "product_id")->withPivot("quantity");
    }

}
