<?php

namespace App\Exports;

use App\CategoryProduct;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelCategoryExports implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CategoryProduct::all();
    }
}