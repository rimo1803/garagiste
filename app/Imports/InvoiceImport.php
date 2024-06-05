<?php

namespace App\Imports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\ToModel;

class InvoiceImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Invoice([
            'repairId'     => $row['repairId'],
            'additionalCharges'    => $row['additionalCharges'],
            'totalAmount' =>$row['totalAmount'],
        ]);
    }
}
