<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //Set time
    public $timestamps = false;
    //Các trường có thể thay đổi
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_password',
        'customer_phone'
    ];
    //Khóa chính
    protected $primaryKey = 'customer_id';
    //Table
    protected $table = 'tbl_customers';
   
}