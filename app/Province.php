<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
     //Set time
     public $timestamps = false;
     //Các trường có thể thay đổi
     protected $fillable = [
         'name_quanhuyen',
         'type',
         'matp'
     ];
     //Khóa chính
     protected $primaryKey = 'maqh';
     //Table
     protected $table = 'tbl_quanhuyen';
}