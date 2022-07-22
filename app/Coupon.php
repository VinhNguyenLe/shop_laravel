<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //Set time
    public $timestamps = false;
    //Các trường có thể thay đổi
    protected $fillable = [
        'coupon_name',
        'coupon_code',
        'coupon_time',
        'coupon_number',
        'coupon_condition'
    ];
    //Khóa chính
    protected $primaryKey = 'coupon_id';
    //Table
    protected $table = 'tbl_coupon';
   
}