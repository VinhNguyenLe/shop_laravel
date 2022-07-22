<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    //Set time
    public $timestamps = false;
    //Các trường có thể thay đổi
    protected $fillable = [
        'fee_matp',
        'fee_maqh',
        'fee_xaid',
        'fee_feeship'
    ];
    //Khóa chính
    protected $primaryKey = 'fee_id';
    //Table
    protected $table = 'tbl_feeship';
    
    public function city(){
        return $this->belongsTo('App\City', 'fee_matp');
    }

    public function province(){
        return $this->belongsTo('App\Province', 'fee_maqh');
    }
    
    public function wards(){
        return $this->belongsTo('App\Wards', 'fee_xaid');
    }
}