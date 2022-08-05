<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Slider;
use App\Brand;
use App\CategoryProduct;


session_start();

class HomeController extends Controller {
	public function index(Request $request) {
		
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

		//SEO
		$meta_desc = "Chuyên bán điện thoại và máy tính";
		$meta_keyword = "điện thoại, máy tính, phụ kiện điện thoại";
		$meta_title = "Shop điện thoại di động";
		$url_canonical = $request->url();
		//End SEO

		$category_product = DB::table('tbl_category_product')
			->where('category_status', '1')
			->orderby('category_id', 'asc')->get();
		
		// $brand_product = DB::table('tbl_brand')
		// 	->where('brand_status', '1')
		// 	->orderby('brand_id', 'desc')->get();
		$brand_data = array();
		$brand_data_id = array();
		$brand = Brand::all();
		foreach ($brand as $key => $br) {
			array_push($brand_data, $br->brand_name);
			array_push($brand_data_id, $br->brand_id);
		}

		$all_product = DB::table('tbl_product')
			->where('product_status', '1')
			->orderby('product_id', 'desc')
			->get();

		// $all_product = DB::table('tbl_product')
		// ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
		// ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
		// ->orderby('tbl_product.product_id', 'desc')->get();

		return view('pages.home')
			->with('category', $category_product)
			->with('brand', $brand)
			->with('brand_data', $brand_data)
			->with('brand_data_id', $brand_data_id)
			->with('all_product', $all_product)
			->with('slider', $slider);
	}

	public function search(Request $request){
		//SEO
		$meta_desc = "Tìm kiếm sản phẩm";
		$meta_keyword = "Tìm kiếm sản phẩm";
		$meta_title = "Tìm kiếm sản phẩm";
		$url_canonical = $request->url();
		//End SEO
		$keyword = $request->keyword_submit;

		$brand_data = array();
		$brand_data_id = array();
		$brand = Brand::all();
		foreach ($brand as $key => $br) {
			array_push($brand_data, $br->brand_name);
			array_push($brand_data_id, $br->brand_id);
		}

		$category_product = DB::table('tbl_category_product')
		->where('category_status', '1')
		->orderby('category_id', 'asc')->get();

		$brand_product = DB::table('tbl_brand')
		->where('brand_status', '1')
		->orderby('brand_id', 'desc')->get();

		$search_product = DB::table('tbl_product')
			->where('product_name', 'like', '%'.$keyword.'%')
			->get();
		return view('pages.product.search')
			->with('category', $category_product)
			->with('brand', $brand_product)
			->with('brand_data', $brand_data)
			->with('brand_data_id', $brand_data_id)
			->with('search_product', $search_product)
			->with('meta_desc', $meta_desc)
			->with('meta_keyword', $meta_keyword)
			->with('meta_title', $meta_title)
			->with('url_canonical', $url_canonical);
	}

	public function contact(){
		$category = CategoryProduct::where('category_status', '1')
		->orderby('category_id', 'desc')->get();

		$brand = Brand::all();
		$brand_data = array();
		$brand_data_id = array();
		foreach ($brand as $key => $br) {
			array_push($brand_data, $br->brand_name);
			array_push($brand_data_id, $br->brand_id);
		}
		return view('pages.contact.contact')->with(compact('category', 'brand', 'brand_data', 'brand_data_id'));
	}

	public function footer(){
		return view('pages.contact.footer');

	}
}