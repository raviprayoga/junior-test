<?php

namespace App\Exports;

use App\Model_Companies;
use Maatwebsite\Excel\Concerns\FromCollection;

class CompaniesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Model_Companies::all();
    }
}
