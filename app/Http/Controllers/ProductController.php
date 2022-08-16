<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

use App\Exports\ExcelProductExports;
use Excel;
use Auth;
use App\Gallery;
use App\Brand;
use App\Product;
use App\Comment;

use Carbon\Carbon;
use File;

session_start();

class ProductController extends Controller {
	public function AuthLogin() {
		$admin_id = Auth::id();

		// $admin_id = Session::get('admin_id');
		if ($admin_id) {
			return Redirect::to('dashboard');
		} else {
			return Redirect::to('login-auth')->send();
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
		$data['product_quantity'] = $request->product_quantity;
		$data['product_desc'] = $request->product_desc;
		$data['product_content'] = $request->product_content;
		$data['product_cost'] = $request->product_cost;
		$data['product_price'] = $request->product_price;
		$data['product_sold'] = 0;
		$data['product_status'] = $request->product_status;
		$data['category_id'] = $request->product_category;
		$data['brand_id'] = $request->product_brand;
		// $data['product_image'] = $request->product_image;

		$get_image = $request->file('product_image');
		$path = 'public/uploads/product/';
		$path_gallery = 'public/uploads/gallery/';
		
		if ($get_image) {
			$get_name_image = $get_image->getClientOriginalName();
			$name_image = current(explode('.', $get_name_image));
			$new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
			$get_image->move($path, $new_image);
			// $get_image->move($path_gallery, $new_image);
			File::copy($path.$new_image, $path_gallery.$new_image);
			$data['product_image'] = $new_image;
		}
		$pro_id = DB::table('tbl_product')->insertGetId($data);
		$gallery = new Gallery();
		$gallery->gallery_image = $new_image;
		$gallery->gallery_name = $name_image;
		$gallery->product_id = $pro_id;
		$gallery->save();

		Session::put('message', 'Thêm sản phẩm thành công');
		return Redirect::to('all-product');
		// $data['product_image'] = '';
		// DB::table('tbl_product')->insert($data);
		// Session::put('message', 'Thêm sản phẩm thành công');
		// return Redirect::to('all-product');
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
		$data['product_quantity'] = $request->product_quantity;
		$data['product_desc'] = $request->product_desc;
		$data['product_content'] = $request->product_content;
		$data['product_cost'] = $request->product_cost;
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
			$brand_data = array();
			$brand_data_id = array();
			$brand = Brand::all();
			foreach ($brand as $key => $br) {
				array_push($brand_data, $br->brand_name);
				array_push($brand_data_id, $br->brand_id);
			}

		$details_product = DB::table('tbl_product')
			->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
			->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
			->where('tbl_product.product_id', $product_id)->get();

		foreach ($details_product as $key => $value) {
			$category_id = $value->category_id;
			$brand_id = $value->brand_id;
			$product_id = $value->product_id;

			$meta_desc = $value->product_desc;
			$meta_keyword = $value->product_name;
			$meta_title = $value->product_name;
			$url_canonical = $request->url();
		}

		$gallery = Gallery::where('product_id', $product_id)->get();


		$related_product = DB::table('tbl_product')
			->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
			->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
			->where('tbl_brand.brand_id', $brand_id)
			->whereNotIn('tbl_product.product_id', [$product_id])->get();

		return view('pages.product.show_details')
			->with('category', $category_product)
			->with('brand', $brand_product)
			->with('brand_data', $brand_data)
			->with('brand_data_id', $brand_data_id)
			->with('details_product', $details_product)
			->with('related_product', $related_product)
			->with('gallery', $gallery)
			->with('meta_desc', $meta_desc)
			->with('meta_keyword', $meta_keyword)
			->with('meta_title', $meta_title)
			->with('url_canonical', $url_canonical);
	}

	public function export_product_csv(){
        return Excel::download(new ExcelProductExports , 'product_list.xlsx');
    }

	public function load_comment(Request $request){
		$product_id = $request->product_id;
		$comment = Comment::where('comment_product_id', $product_id)->where('comment_parent_id', 0)->get();
		$all_comment = Comment::where('comment_product_id', $product_id)->get();
		$output = '';
		foreach($comment as $key => $cmt){
			// $cmt_date = $cmt->comment_date->format('d/m/Y');
			$cmt_date = date('d/m/Y H:i:s', strtotime($cmt->comment_date));
			$output .= '
			<div class="row style_comment"
				style="background-color: #ede1fe; display: flex; align-items: stretch; padding: 12px; margin-inline:unset">
				
				<div class="col-md-1" style="background-color: #fff; padding: 12px">
					<img src="'.url('/public/frontend/images/avatar-icon.png').'" alt="" width="80px"
						class="img img-responsive img-thumbnail">
				</div>
				<div class="col-md-8" style="background-color: #fff;">
					<p style="color: #7d2ae8; margin-block: 12px">'.$cmt->comment_name.'</p>
					<p style="color: #656768; font-style: italic; font-size: 12px">Ngày '.$cmt_date.'</p>

					<p>'.$cmt->comment.'</p>
				</div>
			</div>';

			foreach ($all_comment as $key => $cmt_rep){
				$reply_date = date('d/m/Y H:i:s', strtotime($cmt_rep->comment_date));

				if($cmt_rep->comment_parent_id == $cmt->comment_id){
					$output .='
					<div class="row style_comment"
						style="background-color: #ede1fe; display: flex; align-items: stretch; width: 60%; padding-bottom: 8px; margin-left: 40px">
						
						<div class="col-md-1" style="background-color: #fff; padding: 8px; display: flex; align-items: center">
							<img src="https://f7-zpcloud.zdn.vn/8694182849937176588/c6f480b37442b61cef53.jpg" alt="" width="80px"
								class="img img-responsive img-thumbnail">
						</div>
						<div class="col-md-8" style="background-color: #fff;padding: 8px; ">
							<p style="color: #7d2ae8; margin-block: 0px; font-size: 11px;">Cửa hàng trả lời</p>
							<p style="color: #656768; font-style: italic; font-size: 10px; margin-block: 0px">Ngày '.$reply_date.'</p>
		
							<p style="margin-block: 0px; font-size: 12px;">'.$cmt_rep->comment.'</p>
						</div>
					</div>
					';
				}
			}
		}
		echo $output;
	}

	public function send_comment(Request $request){
		$product_id = $request->product_id;
		$comment_name = $request->comment_name;
		$comment_content = $request->comment_content;

		$comment = new Comment();
		$comment->comment_name = $comment_name;
		$comment->comment = $comment_content;
		$comment->comment_product_id = $product_id;
		// $comment->comment_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');

		$comment->save();
		Session::put('comment_noti', 'Bạn đã đăng bình luận tại sản phẩm này');
	}

	public function list_comment(){
		$comment = Comment::with('product')->where('comment_parent_id', 0)->orderBy('comment_id', 'desc')->get();
		$all_comment = Comment::with('product')->orderBy('comment_id', 'desc')->get();
		return view('admin.comment.list_comment')->with(compact('comment', 'all_comment'));
	}

	public function reply_comment(Request $request){
		$data = $request->all();
		$comment = new Comment();
		$comment->comment = $data['comment'];
		$comment->comment_name = 'Cửa hàng trả lời';
		$comment->comment_product_id = $data['comment_product_id'];
		$comment->comment_parent_id = $data['comment_id'];
		$comment->save();
		Session::put('reply_cmt', 'Trả lời thành công');
	}
}