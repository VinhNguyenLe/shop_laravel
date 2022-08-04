<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
     //Set time
     public $timestamps = false;
     //Các trường có thể thay đổi
     protected $fillable = [
         'gallery_id',
         'gallery_name',
         'gallery_image',
         'product_id'
     ];
     //Khóa chính
     protected $primaryKey = 'gallery_id';
     //Table
     protected $table = 'tbl_gallery';
}