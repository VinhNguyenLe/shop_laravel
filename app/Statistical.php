<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistical extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'order_date',
        'sales',
        'profit',
        'quantity',
        'total_order'
    ];
    protected $primaryKey = 'td_statistical';
    protected $table = 'tbl_statistical';
}