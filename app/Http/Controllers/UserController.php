<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

use App\Admin;
use App\Roles;

use Auth;

class UserController extends Controller
{
    public function index(){
        $admin = Admin::with('roles')->orderby('admin_id', 'ASC')->paginate(10);
        return view('admin.users.all_user')->with(compact('admin'));
    }

    public function add_user(){
        return view('admin.users.add_user');
    }

    public function store_users(Request $request){
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        $admin->roles()->attach(Roles::where('name','user')->first());
        Session::put('message','Thêm tài khoản thành công');
        return Redirect::to('user');
    }
    
    public function assign_roles(Request $request){
        $data = $request->all();
        if(Auth::id() == $request['admin_id']){
            return redirect()->back()->with('error', 'Bạn không được phân quyền chính mình!');
        }
        
        $user = Admin::where('admin_email',$data['admin_email'])->first();
        $user->roles()->detach();
        
        if($request['admin_role']){
            $user->roles()->attach(Roles::where('name','admin')->first());     
        }
        if($request['manager_role']){
            $user->roles()->attach(Roles::where('name','manager')->first());     
        }
        // if($request['user_role']){
        //     $user->roles()->attach(Roles::where('name','user')->first());     
        // }
        return redirect()->back()->with('message', 'Phân công quyền thành công');
    }

    public function delete_user_roles($admin_id){
        if(Auth::id() == $admin_id){
            return redirect()->back()->with('error', 'Bạn không được quyền xóa chính mình!');
        }
        $admin = Admin::find($admin_id);
        if($admin){
            $admin->roles()->detach();
            $admin->delete();
        }
        return redirect()->back()->with('message', 'Xóa tài khoản thành công!');

    }

    

}