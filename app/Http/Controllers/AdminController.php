<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Login;

use Auth;
session_start();

class AdminController extends Controller {
	public function AuthLogin() {
		// $admin_id = Session::get('admin_id');
		$admin_id = Auth::id();
		if ($admin_id) {
			return Redirect::to('dashboard');
		} else {
			return Redirect::to('login-auth')->send();
		}
	}

	public function index() {
		// $this->AuthLogin();
		$admin_id = Session::get('admin_id');
		if ($admin_id) {
			return Redirect::to('dashboard');
		} else {
			return view('admin_login');
		}
	}
	public function show_dashboard() {
		$this->AuthLogin();
		return view('admin.dashboard');
	}
	public function dashboard(Request $request) {
		//* with outside link
		// $data = $request->all();
		// $admin_email = $data['admin_email'];
		// $admin_password = md5($data['admin_password']);
		// $login = Login::where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
		// $login_count = $login->count();

		// if($login_count){
		// 		Session::put('admin_name', $login->admin_name);
		// 		Session::put('admin_id', $login->admin_id);
	
		// 		return Redirect::to('/dashboard');
		// 	} else {
		// 		Session::put('message', 'Tài khoản hoặc mật khẩu không chính xác!');
		// 		return Redirect::to('/admin');
		// 	}

		$admin_email = $request->admin_email;
		$admin_password = md5($request->admin_password);

		$result = DB::table('tbl_admin')
		->where('admin_email', $admin_email)
		->where('admin_password', $admin_password)
		->first();
		if ($result) {
			Session::put('admin_name', $result->admin_name);
			Session::put('admin_id', $result->admin_id);

			return Redirect::to('/dashboard');
		} else {
			Session::put('message', 'Tài khoản hoặc mật khẩu không chính xác!');
			return Redirect::to('/admin');
		}
	}
	public function log_out() {
		$this->AuthLogin();
		Session::put('admin_name', null);
		Session::put('admin_id', null);
		return Redirect::to('/admin');
	}
}