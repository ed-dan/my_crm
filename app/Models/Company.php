<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;


    private string $productList = "";
    protected $fillable = [
        'name',
        'company_phone'
    ];


    public function products()
    {
        return $this->hasMany(Product::class, 'company_id', 'id');
    }

    public function getProducts()
    {
        foreach ($this->products as $product) { 
             $this->productList .= $product->title . ",\n";
        }
        return strlen($this->productList) ? $this->productList : 'No products' ;
    }
}
