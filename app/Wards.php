<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
      //Set time
      public $timestamps = false;
      //Các trường có thể thay đổi
      protected $fillable = [
          'name_xaphuong',
          'type',
          'maqh'
      ];
      //Khóa chính
      protected $primaryKey = 'xaid';
      //Table
      protected $table = 'tbl_xaphuongthitran';
}