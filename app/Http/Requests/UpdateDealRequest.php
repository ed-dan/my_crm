<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Deal;
use App\Models\LeadProduct;
use Illuminate\Support\Str;
use App\Models\lead;

class UpdateDealRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'city' => ['required'],
            'address' => ['required'],
        ];
    }

    public function validated($key = null, $default = null) : array
    {
        return array_merge(parent::validated(), [
            'stage_id' => 3,
        ]);
    }

    // public function updateProductList(Deal $deal)
    // {
    //     $this->collect()->each( function ($item, $key) use ($deal) {
    //         if(Str::startsWith($key, "count") and $item > 0 ) {
    //             LeadProduct::updateOrCreate([
    //                 "lead_id" => $deal->lead->id,
    //                 "product_id" => Str::substr($key, 5),
    //             ], 
    //             [
    //                 "quantity" => $item
    //             ]);
    //         }    
    //     });
    // }
}
