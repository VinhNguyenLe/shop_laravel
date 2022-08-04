<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Brand;
use Illuminate\Support\Facades\Redirect;
use Session;

use App\Exports\ExcelBrandExports;
use Excel;
use Auth;


session_start();

class BrandController extends Controller {
	public function AuthLogin() {
		$admin_id = Auth::id();

		// $admin_id = Session::get('admin_id');
		if ($admin_id) {
			return Redirect::to('dashboard');
		} else {
			return Redirect::to('login-auth')->send();
		}
	}
	public function add_brand_product() {
		$this->AuthLogin();
		return view('admin.brand.add_brand_product');
	}

	public function all_brand_product() {
		$this->AuthLogin();
		$all_brand_product = DB::table('tbl_brand')->get();
		// $all_brand_product = Brand::all();
		$manager_brand_product = view('admin.brand.all_brand_product')->with('all_brand_product', $all_brand_product);
		return view('admin_layout')->with('admin.brand.all_brand_product', $manager_brand_product);
	}

	public function save_brand_product(Request $request) {
		$this->AuthLogin();

		$data = $request->all();

		$brand = new Brand();
		$brand->brand_name = $data['brand_product_name'];
		$brand->brand_desc = $data['brand_product_desc'];
		$brand->brand_status = $data['brand_product_status'];
		$brand->save();
		// $data = array();
		// $data['brand_name'] = $request->brand_product_name;
		// $data['brand_desc'] = $request->brand_product_desc;
		// $data['brand_status'] = $request->brand_product_status;

		// DB::table('tbl_brand')->insert($data);

		Session::put('message', 'Thêm thương hiệu sản phẩm thành công');
		return Redirect::to('add-brand-product');
	}

	public function edit_brand_product($brand_product_id) {
		$this->AuthLogin();
		// $edit_brand_product = DB::table('tbl_brand')->where('brand_id', $brand_product_id)->get();
		$edit_brand_product = Brand::where('brand_id', $brand_product_id)->get();
		$manager_brand_product = view('admin.brand.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
		return view('admin_layout')->with('admin.brand.edit_brand_product', $manager_brand_product);
	}

	public function active_brand_product($brand_product_id) {
		$this->AuthLogin();
		DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status' => 1]);
		Session::put('message', 'Kích hoạt thương hiệu sản phẩm thành công');

		return Redirect::to('all-brand-product');
	}

	public function unactive_brand_product($brand_product_id) {
		$this->AuthLogin();
		DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status' => 0]);
		Session::put('message', 'Ẩn thương hiệu sản phẩm thành công');

		return Redirect::to('all-brand-product');
	}

	public function update_brand_product(Request $request, $brand_product_id) {
		$this->AuthLogin();
		// $data = array();
		// $data['brand_name'] = $request->brand_product_name;
		// $data['brand_desc'] = $request->brand_product_desc;
		// DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update($data);
		$data = $request->all();

		$brand = Brand::find($brand_product_id);
		$brand->brand_name = $data['brand_product_name'];
		$brand->brand_desc = $data['brand_product_desc'];
		$brand->brand_status = $data['brand_product_status'];
		$brand->save();

		Session::put('message', 'Cập nhật thương hiệu sản phẩm thành công');

		return Redirect::to('all-brand-product');
	}

	public function delete_brand_product($brand_product_id) {
		$this->AuthLogin();
		DB::table('tbl_brand')->where('brand_id', $brand_product_id)->delete();
		Session::put('message', 'Xóa thương hiệu sản phẩm thành công');

		return Redirect::to('all-brand-product');
	}

	public function show_brand_home(Request $request, $brand_id) {
		$category_product = DB::table('tbl_category_product')
			->where('category_status', '1')
			->orderby('category_id', 'asc')->get();

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

		$brand_by_id = DB::table('tbl_product')
			->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')
			->where('tbl_product.brand_id', $brand_id)
			->where('product_status', '1')
			->get();

		$brand_name = DB::table('tbl_brand')
			->where('tbl_brand.brand_id', $brand_id)
			->limit(1)->get();
		
		foreach ($brand_product as $key => $val) {
			$meta_desc = $val->brand_name;
			$meta_keyword = $val->brand_name;
			$meta_title = $val->brand_name;
			$url_canonical = $request->url();
		}

		return view('pages.brand.show_brand')
			->with('category', $category_product)
			->with('brand', $brand_product)
			->with('brand_by_id', $brand_by_id)
			->with('brand_data', $brand_data)
			->with('brand_data_id', $brand_data_id)
			->with('brand_name', $brand_name)
			->with('meta_desc', $meta_desc)
			->with('meta_keyword', $meta_keyword)
			->with('meta_title', $meta_title)
			->with('url_canonical', $url_canonical);
	}

	public function export_brand_csv(){
        return Excel::download(new ExcelBrandExports , 'brand_product.xlsx');
    }
}