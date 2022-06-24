<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //Set time
    public $timestamps = false;
    //Các trường có thể thay đổi
    protected $fillable = [
        'brand_name',
        'brand_desc',
        'brand_status'
    ];
    //Khóa chính
    protected $primaryKey = 'brand_id';
    //Table
    protected $table = 'tbl_brand';
   
}
