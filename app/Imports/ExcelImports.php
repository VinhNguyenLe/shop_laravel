<?php

namespace App\Imports;

use App\CategoryProductModel;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CategoryProduct([
            'category_name' => $row[0],
            'meta_keywords' => $row[1],
            'category_desc' => $row[2],
            'category_status' => $row[3],
        ]);
    }
}