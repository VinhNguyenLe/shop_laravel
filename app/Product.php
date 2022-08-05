<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'product_name',
    	'product_quantity',
        'category_id',
        'brand_id',
        'product_desc',
        'product_content',
        'product_cost',
        'product_price',
        'product_image',
        'product_status'
    ];
    protected $primaryKey = 'product_id';
 	protected $table = 'tbl_product';

    // public function comment(){
    //     return $this->hasMany('App\Comment');
    // }
    public function category(){
        return $this->belongsTo('App\CategoryProduct', 'category_id');
    }
    
    public function brand(){
        return $this->belongsTo('App\Brand', 'brand_id');
    }
}