<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Admin;
use App\Roles;

class AuthController extends Controller
{
    public function register_auth(){
        return view('admin.custom_auth.register');
    }

    public function register(Request $request){
        $this->validation($request);
        $data = $request->all();

        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        return redirect('/register-auth')->with('message', 'Đăng ký thành công');
    }

    public function validation($request){
        return $this->validate($request, [
            'admin_name' => 'required|max:255',
            'admin_phone' => 'required|max:255',
            'admin_email' => 'required|email|max:255',
            'admin_password' => 'required|max:255',
        ]);
    }
}