<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'admin_email', 'admin_password', 'admin_name','admin_phone'
    ];
    protected $primaryKey = 'admin_id';
 	protected $table = 'tbl_admin';

 	public function roles(){
 		return $this->belongsToMany('App\Roles');
 	}

	public function getAuthPassword(){
		return $this->admin_password;
	}
    
 	public function hasAnyRoles($roles){

		if(is_array($roles)){
 			foreach($roles as $role){
 				if($this->hasRole($role)){
 					return true;
 				}
 			}
 		}else{
 			if($this->hasRole($roles)){
 				return true;
 			}
 		}
 		return false;
 	}
    
 	public function hasRole($role){
 		if($this->roles()->where('name',$role)->first()){
 			return true;
 		}
 		return false;
 	}
 	
}