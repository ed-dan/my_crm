<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealEmployee extends Model
{
    use HasFactory;

    protected $fillable = [
        'deal_id',
        'employee_id'
    ];
}
