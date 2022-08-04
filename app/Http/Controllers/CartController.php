<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\Brand;
use Cart;

session_start();

class CartController extends Controller {
	public function save_cart(Request $request) {
		$productId = $request->productid_hidden;
		$quantity = $request->quatity;
		$product_info = DB::table('tbl_product')->where('product_id', $productId)->first();
		
		$data['id'] = $product_info->product_id;
		$data['qty'] = $quantity;
		$data['name'] = $product_info->product_name;
		$data['price'] = $product_info->product_price;
		$data['weight'] = '0';
		$data['options']['image'] = $product_info->product_image;
		
		Cart::add($data);
		Cart::setGlobalTax(10);
		
		return Redirect::to('/show-cart');
		// Cart::destroy();
	}

	public function show_cart(Request $request) {
		$meta_desc = "Giỏ hàng";
		$meta_keyword = "Giỏ hàng";
		$meta_title = "Giỏ hàng";
		$url_canonical = $request->url();
		$category_product = DB::table('tbl_category_product')
			->where('category_status', '1')
			->orderby('category_id', 'desc')->get();

		$brand_product = DB::table('tbl_brand')
			->where('brand_status', '1')
			->orderby('brand_id', 'desc')->get();

		return view('pages.cart.show_cart')
			->with('category', $category_product)
			->with('brand', $brand_product)
			->with('meta_desc', $meta_desc)
			->with('meta_keyword', $meta_keyword)
			->with('meta_title', $meta_title)
			->with('url_canonical', $url_canonical);
	}

	public function delete_to_cart($rowId){
		Cart::update($rowId, 0);

		return Redirect::to('/show-cart');
	}

	public function update_cart_quantity(Request $request){
		$rowId = $request->rowId_cart;
		$qty = $request->cart_quantity;
		Cart::update($rowId, $qty);
		return Redirect::to('/show-cart');
	}

	public function add_cart_ajax(Request $request){
		$data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }
       
        Session::save();

	}

	public function show_cart_ajax(Request $request){
		$meta_desc = "Giỏ hàng";
		$meta_keyword = "Giỏ hàng";
		$meta_title = "Giỏ hàng";
		$url_canonical = $request->url();
		$category_product = DB::table('tbl_category_product')
			->where('category_status', '1')
			->orderby('category_id', 'desc')->get();

		$brand_product = DB::table('tbl_brand')
			->where('brand_status', '1')
			->orderby('brand_id', 'desc')->get();
	
			$brand_data = array();
			$brand_data_id = array();
			$brand = Brand::all();
			foreach ($brand as $key => $br) {
				array_push($brand_data, $br->brand_name);
				array_push($brand_data_id, $br->brand_id);
			}

		return view('pages.cart.cart_ajax')
			->with('category', $category_product)
			->with('brand', $brand_product)
			->with('brand_data', $brand_data)
			->with('brand_data_id', $brand_data_id)
			->with('meta_desc', $meta_desc)
			->with('meta_keyword', $meta_keyword)
			->with('meta_title', $meta_title)
			->with('url_canonical', $url_canonical);
	}

	public function update_cart_ajax(Request $request){
		$data = $request -> all();
		$cart = Session::get('cart');
		if($cart == true){
			$message = '';
			foreach($data['cart_qty'] as $key => $qty){
                $i = 0;
                foreach($cart as $session => $val){
                    $i++;
                    if($val['session_id']==$key && $qty<$cart[$session]['product_quantity']){
                        $cart[$session]['product_qty'] = $qty;
                        $message.='<p style="color:blue">'.$i.'. Cập nhật số lượng: '.$cart[$session]['product_name'].' thành công</p>';
                    }elseif($val['session_id']==$key && $qty>$cart[$session]['product_quantity']){
                        $message.='<p style="color:red">'.$i.'. Cập nhật số lượng: '.$cart[$session]['product_name'].' thất bại</p>';
                    }
                }
            }

			Session::put('cart', $cart);
			return redirect()->back()->with('message', $message);
		} else {
			return redirect()->back()->with('error', 'Cập nhật số lượng thất bại');

		}
	}

	public function delete_product_ajax($session_id){
		$cart = Session::get('cart');
        // echo '<pre>';
        // print_r($cart);
        // echo '</pre>';
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');

        }else{
            return redirect()->back()->with('message','Xóa sản phẩm thất bại');
        }
		
	}

	public function delete_all_product_ajax(){
		$cart = Session::get('cart');
        if($cart==true){
            // Session::destroy();
            Session::forget('cart');
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa hết giỏ thành công');
        }
	}

	
}