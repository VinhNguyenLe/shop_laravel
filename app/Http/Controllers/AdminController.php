<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Login;
use App\Brand;
use App\Order;
use App\Product;
use App\CategoryProduct;

use App\Statistical;
use App\OrderDetails;

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
		$order_unprocess = Order::where('order_status', 1)->count();
		$order_success = Order::where('order_status', 2)->count();
		$order_cancel = Order::where('order_status', 3)->count();

		$brand = Brand::orderby('brand_id', 'DESC')->get();
		$product = Product::orderby('product_id', 'DESC')->get();
		$category = CategoryProduct::orderby('category_id', 'DESC')->get();

		$product_count = $product->count();
		$sold_count = 0;
		$warehouse = 0;
		foreach ($product as $key => $item) {
			$sold_count += $item->product_sold;
			$warehouse += $item->product_quantity;
		}
            
		return view('admin.dashboard')
		->with(compact('order_unprocess', 'order_success', 'order_cancel', 'sold_count', 'warehouse', 'product_count' 
		,'brand', 'product', 'category'));
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

	public function filter_by_date(Request $request){
		$data = $request->all();
		$from_date = $data['from_date'];
		$to_date = $data['to_date'];

		$get = Statistical::whereBetween('order_date', [$from_date, $to_date])->orderBy('order_date', 'ASC')->get();

		foreach($get as $key => $val){
			$chart_data[] = array(
				'period' => $val->order_date,
				'order' => $val->total_order,
				'sales' => $val->sales,
				'profit' => $val->profit,
				'quantity' => $val->quantity,
			);
		}
		$data = json_encode($chart_data);
		echo $data;
	}
}