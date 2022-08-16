<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'comment',
        'comment_name',
        'comment_date',
        'comment_product_id',
        'comment_parent_id'
    ];
    protected $primaryKey = 'comment_id';
 	protected $table = 'tbl_comment';

     public function product(){
        return $this->belongsTo('App\Product', 'comment_product_id');
    }

}