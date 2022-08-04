<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
      public $timestamps = false;
      protected $fillable = [
          'contact_title',
          'contact_content',
          'contact_status'
      ];
      //Khóa chính
      protected $primaryKey = 'contact_id';
      //Table
      protected $table = 'tbl_contact';
}