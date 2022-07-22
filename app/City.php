<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
     //Set time
     public $timestamps = false;
     //Các trường có thể thay đổi
     protected $fillable = [
         'name_city',
         'type'
     ];
     //Khóa chính
     protected $primaryKey = 'matp';
     //Table
     protected $table = 'tbl_tinhthanhpho';
}