<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Builder;

class Deal extends Model
{
    public const SUCCESS_DEALS = 4;
    use HasFactory;
    use Sortable;

    private string $productList = "";
    private int $currentAmount = 0;
    protected $fillable = [
        'employee_id',
        'lead_id',
        'closing_date',
        'status_id',
        'task_id',
        'city',
        'address',
        'amount'
    ];
    protected array $sortable = ['city', 'position_id', 'created_at', 'email'];

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

    public function scopeWithQueryString($query, $request) 
    {
        if ($request->hasAny(["status", "search"])) {
            if($request->query("status") == "city"){
                $query = $query->where($request->query("status"), "like", "%" . $request->query("search") . "%");
            }
            if($request->query("employee")){
                $query = $query->where("employee_id", $request->query("employee"));
            }
            if($request->query("status") == "name"){
                $query = $query->whereHas("lead", function (Builder $leadQuery) use ($request) {
                    $leadQuery->where("name", "like", "%" . $request->query("search") . "%");
                });
            }
            if($request->query("status") == "title"){
                $query = $query->whereHas("status", function (Builder $statusQuery) use ($request) {
                    $statusQuery->where("title", "like", "%" . $request->query("search") . "%");
                });
            }
        }
        return $query->orderBy($request->query("sort", "closing_date"), $request->query("direction", "desc"));
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
        return $this->belongsToMany(Product::class, "deal_products", "deal_id", "product_id")->withPivot("quantity");
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

    // public static function searcher($name, $deals, $employees, $products, $stages, $leads)
    // {
    //     $deal_query = $deals
    //         ->where($name, 'like', '%' . request('search') . '%')
    //         ->paginate(8);

    //     return view("deals.index", [
    //         'deals' => $deal_query,
    //         'employees' => $employees,
    //         'products' => $products,
    //         'stages' => $stages,
    //         'leads' => $leads
    //     ]);
    // }

    public function getProductList() : string  
    {
        foreach ($this->products as $product) { 
            $this->productList .= $product->pivot->quantity . "x " .$product->title . ",\n";
        }
        return strlen($this->productList) ? $this->productList : "Empty" ;
    }

    public function showProducts(): string 
    {
        $result = "";
        foreach (session()->all() as $key => $value) {
            if(Str::startsWith($key, "id")) { 
                $product = Product::find(Str::substr($key, 2));
                dd($product);
            }   
        }
        return (str); 
    }

    public function getDealAmount(): int 
    {
        foreach($this->products as $dealProduct) {
            $this->currentAmount += $dealProduct->pivot->quantity * $dealProduct->price;
            dump($this->currentAmount);
        }
        return $this->currentAmount;
    }

}
