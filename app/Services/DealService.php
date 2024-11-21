<?php

namespace App\Services;

use App\Models\Deal;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use App\Models\Lead;
use App\Models\EmployeeLead;
use App\Models\DealEmployee;
use App\Models\LeadProduct;
use App\Models\DealProduct;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateDealRequest;
use Illuminate\Support\Str;

class DealService
{
        
    public function openDeal(array $request, Lead $lead) : Deal
    {
        $deal = $lead->deals->last();

        if($deal){
            $lead->update($request);
            return $deal;
        }
        else{
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
        dd($dealRequest->request);
        $dealRequest->collect()->each( function ($item, $key) use ($deal) {
            if(Str::startsWith($key, "count") and $item > 0 ) {
                LeadProduct::updateOrCreate([
                    "lead_id" => $deal->lead->id,
                    "product_id" => Str::substr($key, 5),
                ], 
                [
                    "quantity" => $item
                ]);
            }    
        });
        $deal->update($dealRequest->validated());
    }

    public function closeDeal(Deal $deal) : void
    {
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

    public function confirm(Deal $deal) : Deal
    {
        foreach($deal->lead->products as $leadProduct){
            DealProduct::updateOrCreate([
                "deal_id" => $deal->id,
                "product_id" => $leadProduct->id,
            ], 
            [
                "quantity" => $leadProduct->pivot->quantity
            ]);
        }
        return $deal;
    }
    
}
