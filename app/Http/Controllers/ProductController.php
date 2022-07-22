<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

session_start();

class ProductController extends Controller {
	public function AuthLogin() {
		$admin_id = Session::get('admin_id');
		if ($admin_id) {
			return Redirect::to('dashboard');
		} else {
			return Redirect::to('admin')->send();
		}
	}
	public function add_product() {
		$this->AuthLogin();
		$category_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
		$brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();

		return view('admin.product.add_product')->with('category_product', $category_product)->with('brand_product', $brand_product);
	}

	public function all_product() {
		$this->AuthLogin();
		$all_product = DB::table('tbl_product')
			->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
			->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
			->orderby('tbl_product.product_id', 'desc')->get();

		$manager_product = view('admin.product.all_product')->with('all_product', $all_product);
		return view('admin_layout')->with('admin.product.all_product', $manager_product);
	}

	public function save_product(Request $request) {
		$this->AuthLogin();
		$data = array();
		$data['product_name'] = $request->product_name;
		$data['product_desc'] = $request->product_desc;
		$data['product_content'] = $request->product_content;
		$data['product_price'] = $request->product_price;
		$data['product_status'] = $request->product_status;
		$data['category_id'] = $request->product_category;
		$data['brand_id'] = $request->product_brand;
		// $data['product_image'] = $request->product_image;

		$get_image = $request->file('product_image');

		if ($get_image) {
			$get_name_image = $get_image->getClientOriginalName();
			$name_image = current(explode('.', $get_name_image));
			$new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
			$get_image->move('public/uploads/product', $new_image);

			$data['product_image'] = $new_image;

			DB::table('tbl_product')->insert($data);
			Session::put('message', 'Thêm sản phẩm thành công');
			return Redirect::to('add-product');
		}
		$data['product_image'] = '';
		DB::table('tbl_product')->insert($data);
		Session::put('message', 'Thêm sản phẩm thành công');
		return Redirect::to('add-product');
	}

	public function edit_product($product_id) {
		$this->AuthLogin();
		$category_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
		$brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();

		$edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
		$manager_product = view('admin.product.edit_product')->with('edit_product', $edit_product)->with('category_product', $category_product)->with('brand_product', $brand_product);

		return view('admin_layout')->with('admin.product.edit_product', $manager_product);
	}

	public function active_product($product_id) {
		$this->AuthLogin();
		DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
		Session::put('message', 'Kích hoạt sản phẩm thành công');

		return Redirect::to('all-product');
	}

	public function unactive_product($product_id) {
		$this->AuthLogin();
		DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
		Session::put('message', 'Ẩn thương phẩm thành công');

		return Redirect::to('all-product');
	}

	public function update_product(Request $request, $product_id) {
		$this->AuthLogin();
		$data = array();
		$data['product_name'] = $request->product_name;
		$data['product_desc'] = $request->product_desc;
		$data['product_content'] = $request->product_content;
		$data['product_price'] = $request->product_price;
		$data['product_status'] = $request->product_status;
		$data['category_id'] = $request->product_category;
		$data['brand_id'] = $request->product_brand;

		$get_image = $request->file('product_image');

		if ($get_image) {
			$get_name_image = $get_image->getClientOriginalName();
			$name_image = current(explode('.', $get_name_image));
			$new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
			$get_image->move('public/uploads/product', $new_image);
			$data['product_image'] = $new_image;
			DB::table('tbl_product')->where('product_id', $product_id)->update($data);
			Session::put('message', 'Cập nhật sản phẩm thành công');
			return Redirect::to('all-product');
		}
		DB::table('tbl_product')->where('product_id', $product_id)->update($data);

		Session::put('message', 'Cập nhật sản phẩm thành công');
		return Redirect::to('all-product');
	}

	public function delete_product($product_id) {
		$this->AuthLogin();
		DB::table('tbl_product')->where('product_id', $product_id)->delete();
		Session::put('message', 'Xóa sản phẩm thành công');

		return Redirect::to('all-product');
	}
	//End Admin Page
	public function details_product(Request $request, $product_id) {
		$category_product = DB::table('tbl_category_product')
			->where('category_status', '1')
			->orderby('category_id', 'desc')->get();

		$brand_product = DB::table('tbl_brand')
			->where('brand_status', '1')
			->orderby('brand_id', 'desc')->get();

		$details_product = DB::table('tbl_product')
			->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
			->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
			->where('tbl_product.product_id', $product_id)->get();

		foreach ($details_product as $key => $value) {
			$category_id = $value->category_id;
			$brand_id = $value->brand_id;

			$meta_desc = $value->product_desc;
			$meta_keyword = $value->product_name;
			$meta_title = $value->product_name;
			$url_canonical = $request->url();
		}

		$related_product = DB::table('tbl_product')
			->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
			->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
			->where('tbl_brand.brand_id', $brand_id)
			->whereNotIn('tbl_product.product_id', [$product_id])->get();

		return view('pages.product.show_details')
			->with('category', $category_product)
			->with('brand', $brand_product)
			->with('details_product', $details_product)
			->with('related_product', $related_product)
			->with('meta_desc', $meta_desc)
			->with('meta_keyword', $meta_keyword)
			->with('meta_title', $meta_title)
			->with('url_canonical', $url_canonical);
	}
}