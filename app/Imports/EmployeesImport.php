<?php

namespace App\Imports;

use App\Model_Employees;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Model_Employees([
            'first_name' => $row[1],
            'last_name' => $row[2],
            'company_id' =>$row[3],
            'email' => $row[4],
            'password' => bcrypt($row[5]),
            'phone' =>$row[6],
            'created_by_id' => $row[7],
            'updated_by_id' => $row[8],
        ]);
    }
}
