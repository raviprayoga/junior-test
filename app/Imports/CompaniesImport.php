<?php

namespace App\Imports;

use App\Model_Companies;
use Maatwebsite\Excel\Concerns\ToModel;

class CompaniesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Model_Companies([
            'name' => $row[1],
            'email' => $row[2],
            'logo' =>$row[3],
            'created_by_id' => $row[4],
            'updated_by_id' => $row[5],
        ]);
        
    }
}
