<?php

namespace App\Services;

use App\Models\{Deal, Status, Task, User, Lead, Product, EmployeeLead, DealEmployee, LeadProduct, DealProduct};
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateDealRequest;
use Illuminate\Support\Str;

class DealService
{
        
    public function openDeal(array $request, Lead $lead) : Deal
    {
        $deal = $lead->deals->last();

        if($deal) {
            $lead->update($request);
            return $deal;
        }
        else {

            EmployeeLead::create([
                "employee_id" => $request["employee_id"],
                "lead_id" => $lead->id
            ]);    

            $deal = Deal::create([
                "employee_id" => $request["employee_id"],
                "lead_id" => $lead->id,
                "closing_date" => date('Y-m-d h:i:s', time()),
                "status_id" => 3
            ]);
            
            $lead->update($request);
            return $deal;
        }
    }

    public function update(Deal $deal, UpdateDealRequest $dealRequest)
    {
        foreach ($dealRequest->session()->all() as $key => $value) {
            if(Str::startsWith($key, "id")) { 
                $dealRequest->session()->forget($key);
            }   
        }

        $dealRequest->collect()->each( function ($item, $key) use ($dealRequest) {
            if((Str::startsWith($key, "id") and $item > 0)  ) { 
                $dealRequest->session()->put($key, $item);
            }      
        });

        $deal->update($dealRequest->validated());
    }

    public function closeDeal(Deal $deal) : void
    {
        foreach (session()->all() as $key => $value) {
            if(Str::startsWith($key, "id")) {
               
                DealProduct::create([ 
                    "deal_id" => $deal->id,
                    "product_id" => Str::substr($key, 2),
                    "quantity" => $value
                ]);
            }
        }

        DealEmployee::create([
            "employee_id" => $deal->employee->id,
            "deal_id" => $deal->id
        ]);
        
        $deal->update([
            "status_id" => 1,
            "stage_id" => Deal::SUCCESS_DEALS,
            "amount" => $deal->getDealAmount(),
        ]);
    }

    public function reject(Deal $deal) : void
    {
        $formFields = \request()->validate([
            'status' => ['required'],
        ]);
        $deal->update([
            "status_id" => $formFields['status']
        ]);
    }

//  retrieve products from the global session
//  then calculate the deal amount and generate a list of products 
    public function prepareDeal(): void
    {
        $result = "";
        $amount = 0;
        foreach (session()->all() as $key => $value) {
            if(Str::startsWith($key, "id")) { 
                $product = Product::find(Str::substr($key, 2));
                $result .= $value . "x " . $product->title . ",\n";
                $amount += $value * $product->price;
            }   
        }

        session()->put("amount", $amount);
        session()->put("product_list", $result);
    }
    
}
