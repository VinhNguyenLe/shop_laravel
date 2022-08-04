<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\Coupon;
use App\Brand;
use App\CategoryProduct;
use Auth;
use Carbon\Carbon;

session_start();


class CouponController extends Controller
{
    //Client
    public function check_coupon(Request $request){
        $today = Carbon::now('asia/Ho_Chi_Minh')->format('Y-m-d');

        $data = $request->all();
        $coupon = Coupon::where('coupon_code',$data['coupon'])
        ->where('coupon_status', 1)
        ->where('coupon_date_end', '>=', $today)
        ->first();
        $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon>0){
                $coupon_session = Session::get('coupon');
                if($coupon_session==true){
                    $is_avaiable = 0;
                    if($is_avaiable==0){
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,

                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,

                        );
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message','Thêm mã giảm giá thành công');
            }

        }else{
            return redirect()->back()->with('error','Mã giảm giá không đúng hoặc đã hết hạn');
        }
    } 

    public function unset_coupon(){
        $coupon = Session::get('coupon');
        if($coupon==true){
            // Session::destroy();
            Session::forget('coupon');
            return redirect()->back()->with('message','Đã hủy sử dụng mã khuyến mãi');
        }
    }

    //Admin
    public function AuthLogin() {
		$admin_id = Auth::id();

		// $admin_id = Session::get('admin_id');
		if ($admin_id) {
			return Redirect::to('dashboard');
		} else {
			return Redirect::to('login-auth')->send();
		}
	}

    public function add_coupon(){
		$this->AuthLogin();

        return view('admin.coupon.insert_coupon');
    }

    public function insert_coupon_code(Request $request){
		$this->AuthLogin();

        $data = $request->all();
        $coupon = new Coupon;
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_time = $data['coupon_time'];
        $coupon->coupon_date_start = $data['coupon_date_start'];
        $coupon->coupon_date_end = $data['coupon_date_end'];
        $coupon->save();

        Session::put('message', 'Thêm mã giảm giá thành công');
        return Redirect::to('list-coupon');
    }

    public function list_coupon(){
		$this->AuthLogin();
        $today = Carbon::now('asia/Ho_Chi_Minh')->format('Y-m-d');
        $coupon = Coupon::orderby('coupon_id', 'DESC')->get();
        return view('admin.coupon.list_coupon')->with(compact('coupon', 'today'));
    }

    public function delete_coupon($coupon_id){
		$this->AuthLogin();

        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        Session::put('message', 'Xóa mã giảm giá thành công');

        return Redirect::to('list-coupon');


    }

    public function show_all_coupon(){
        $today = Carbon::now('asia/Ho_Chi_Minh')->format('Y-m-d');

        $coupon = Coupon::where('coupon_status', 1)->get();
        $category = CategoryProduct::where('category_status', '1')
		->orderby('category_id', 'desc')->get();

		$brand = Brand::all();
		$brand_data = array();
		$brand_data_id = array();
		foreach ($brand as $key => $br) {
			array_push($brand_data, $br->brand_name);
			array_push($brand_data_id, $br->brand_id);
		}
        return view('pages.coupon.show_all_coupon')->with(compact('coupon', 'category', 'brand', 'today', 'brand_data', 'brand_data_id'));
    }
}