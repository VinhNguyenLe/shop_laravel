<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

use App\Imports\ExcelImports;
use App\Brand;
use App\Exports\ExcelCategoryExports;
use Excel;
use Auth;


use CategoryProduct;

session_start();

class CategoryController extends Controller {
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
	public function add_category_product() {
		$this->AuthLogin();
		return view('admin.category.add_category_product');
	}

	public function all_category_product() {
		$this->AuthLogin();
		$all_category_product = DB::table('tbl_category_product')->get();
		$manager_category_product = view('admin.category.all_category_product')->with('all_category_product', $all_category_product);
		return view('admin_layout')->with('admin.category.all_category_product', $manager_category_product);
	}

	public function save_category_product(Request $request) {
		$this->AuthLogin();
		$data = array();
		$data['category_name'] = $request->category_product_name;
		$data['meta_keywords'] = $request->category_product_keywords;
		$data['category_desc'] = $request->category_product_desc;
		$data['category_status'] = $request->category_product_status;

		DB::table('tbl_category_product')->insert($data);
		Session::put('message', 'Thêm danh mục sản phẩm thành công');
		return Redirect::to('add-category-product');
	}

	public function edit_category_product($category_product_id) {
		$this->AuthLogin();
		$edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();
		$manager_category_product = view('admin.category.edit_category_product')->with('edit_category_product', $edit_category_product);
		return view('admin_layout')->with('admin.category.edit_category_product', $manager_category_product);
	}

	public function active_category_product($category_product_id) {
		$this->AuthLogin();
		DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 1]);
		Session::put('message', 'Kích hoạt danh mục sản phẩm thành công');

		return Redirect::to('all-category-product');
	}

	public function unactive_category_product($category_product_id) {
		$this->AuthLogin();
		DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 0]);
		Session::put('message', 'Ẩn danh mục sản phẩm thành công');

		return Redirect::to('all-category-product');
	}

	public function update_category_product(Request $request, $category_product_id) {
		$this->AuthLogin();
		$data = array();
		$data['category_name'] = $request->category_product_name;
		$data['category_desc'] = $request->category_product_desc;
		$data['meta_keywords'] = $request->category_product_keywords;


		DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);
		Session::put('message', 'Cập nhật danh mục sản phẩm thành công');

		return Redirect::to('all-category-product');
	}

	public function delete_category_product($category_product_id) {
		$this->AuthLogin();
		DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
		Session::put('message', 'Xóa danh mục sản phẩm thành công');

		return Redirect::to('all-category-product');
	}
	//End admin

	//Home
	public function show_category_home(Request $request, $category_id) {
			
	
		$category_product = DB::table('tbl_category_product')
			->where('category_status', '1')
			->orderby('category_id', 'desc')->get();

		$brand_product = DB::table('tbl_brand')
			->where('brand_status', '1')
			->orderby('brand_id', 'desc')->get();

		$category_by_id = DB::table('tbl_product')
			->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
			->where('tbl_product.category_id', $category_id)
			->where('product_status', '1')
			->get();
			$brand_data = array();
		$brand_data_id = array();
		$brand = Brand::all();
		foreach ($brand as $key => $br) {
			array_push($brand_data, $br->brand_name);
			array_push($brand_data_id, $br->brand_id);
		}

		foreach ($category_product as $key => $val) {
			$meta_desc = $val->category_name;
			$meta_keyword = $val->meta_keywords;
			$meta_title = $val->category_name;
			$url_canonical = $request->url();
		}

		$category_name = DB::table('tbl_category_product')
			->where('tbl_category_product.category_id', $category_id)
			->limit(1)->get();

		return view('pages.category.show_category')
			->with('category', $category_product)
			->with('brand', $brand_product)
			->with('brand_data', $brand_data)
			->with('brand_data_id', $brand_data_id)
			->with('category_by_id', $category_by_id)
			->with('meta_desc', $meta_desc)
			->with('meta_keyword', $meta_keyword)
			->with('meta_title', $meta_title)
			->with('url_canonical', $url_canonical)
			->with('category_name', $category_name);
	}

	public function export_category_csv(){
        return Excel::download(new ExcelCategoryExports , 'category_product.xlsx');
    }
    // public function import_csv(Request $request){
    //     $path = $request->file('file')->getRealPath();
    //     Excel::import(new ExcelImports, $path);
    //     return back();
    // }
  

}