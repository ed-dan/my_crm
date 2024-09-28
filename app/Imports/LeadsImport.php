<?php

namespace App\Imports;

use App\Models\Lead;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class LeadsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row): \Illuminate\Database\Eloquent\Model|Lead|null
    {
//        if (isset($row[0]) and $row[0] != 0){
//            return new Lead([
//                'name' => $row[0],
//                'phone' => $row[1],
//                'email' => $row[2],
//                'product_id' => $row[3],
//                'source' => $row[4],
//            ]);
//
//        }
        return null;
   }
}
