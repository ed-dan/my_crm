<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['title', 'identifier', 'company_id', 'category_id', 'price'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }


    public function deal()
    {
        return $this->belongsToMany(Deal::class, 'deal_products',
            'product_id', 'deal_id');
    }


}
