<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Deal extends Model
{
    public const SUCCESS_DEALS = 4;
    use HasFactory;
    use Sortable;

    protected array $sortable = ['city', 'position_id', 'created_at', 'email', 'salary'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }
    }

    public function scopeWithManager($query)
    {
        return !intval(request()->manager) ? $query : $query->where("employee_id", "=", request()->manager);
    }

    public function scopeCountSuccessDeals($query, $manager_id = null)
    {
        if ($manager_id)
            $query->where("employee_id", $manager_id);
        return $query->where("stage_id", self::SUCCESS_DEALS)->count();
    }

    public function scopeWithPeriod($query, string $period = null)
    {
        if (str_starts_with($period, "Y"))
            return $query->whereYear("closing_date", substr($period, 1));
        if (str_starts_with($period, "m"))
            return $query->whereMonth("closing_date", substr($period, 1));
        if (str_starts_with($period, "d"))
            return $query->whereDay("closing_date", substr($period, 1));
    }

    public function employee()
    {
        return $this->belongsTo(User::class, "employee_id", "id");
    }

    public function status()
    {
        return $this->belongsTo(Status::class, "status_id", "id");
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'deal_products',
            'product_id', 'deal_id');
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id', 'id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'note_id', 'deal_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'deal_id', 'task_id');
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id', 'id');
    }
    public function deal_employee()
    {
        return $this->hasOne(DealEmployee::class, 'deal_id', 'id');
    }
///////////////////////////////////////
    public function withPeriodRequest(string $period = "")
    {
        return $this->whereYear("closing_date", substr($period, 1));
    }

    public static function searcher($name, $deals, $employees, $products, $stages, $leads)
    {
        $deal_query = $deals
            ->where($name, 'like', '%' . request('search') . '%')
            ->paginate(8);
        return view("deals.index", [
            'deals' => $deal_query,
            'employees' => $employees,
            'products' => $products,
            'stages' => $stages,
            'leads' => $leads
        ]);
    }

    public function countDealAmount(array $product_list)
    {
        foreach ($product_list as $product_item) {
            $amount_item = explode("*", $product_item);
            $product = DB::table("products")
                ->where("id", "=", $amount_item[0])
                ->get();
            dd($product);
        }


    }
}