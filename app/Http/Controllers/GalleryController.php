<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use Auth;

use App\Gallery;
use App\Product;

session_start();

class GalleryController extends Controller
{
    public function AuthLogin() {
		$admin_id = Auth::id();
		if ($admin_id) {
			return Redirect::to('dashboard');
		} else {
			return Redirect::to('login-auth')->send();
		}
	}

    public function add_gallery($productId){
        $product_id = $productId;
		$product_name = Product::where('product_id', $productId)->first()->product_name;
        return view('admin.gallery.add_gallery')->with(compact('product_id', 'product_name'));
    }

	public function select_gallery(Request $request){
		$product_id = $request->product_id;
		$gallery = Gallery::where('product_id', $product_id)->get();
		$gallery_count = $gallery->count();
		$output = '
		<form>
		'.csrf_field().'
			<table class="table table-hover">
			<thead>
				<tr>
					<th style="text-align: center">STT</th>
					<th>Tên hình ảnh</th>
					<th style="text-align: center">Hình ảnh</th>
					<th style="text-align: center">Hành động</th>
				</tr>
			</thead>
			<tbody>';
		if($gallery_count > 0){
			$i = 0;
			foreach($gallery as $key => $gal){
				$i++;
				$output .= '
				<tr>
					<td style="text-align: center">'.$i.'</td>
					<td contenteditable class="custom-contenteditable edit_gal_name" data-gal_id="'.$gal->gallery_id.'">'.$gal->gallery_name.'</td>
					<td style="text-align: center">
						<img src='.url('/public/uploads/gallery/'.$gal->gallery_image).' alt="gallery" width="120" class="img-thumbnail" />
					</td>
					<td style="text-align: center">
						<button type="button" class="btn btn-danger delete_gallery"  data-gallery_id="'.$gal->gallery_id.'">Xóa</button>
					</td>
				</tr>
				';
			}
		} else {
			$output .= '
				<tr>
					<td colspan="4" style="text-align: center">Sản phẩm chưa có hình ảnh phụ</td>
				</tr>
			';
		}
		$output .= '
			</tbody>
		</table>
		</form>
		';
		echo $output;
	}

	public function insert_gallery(Request $request, $productId){
		$get_image = $request->file('file');
		if($get_image){
			foreach($get_image as $key => $image){
				$get_name_image = $image->getClientOriginalName();
				$name_image = current(explode('.', $get_name_image));
				$new_image = $name_image . rand(0, 99) . '.' . $image->getClientOriginalExtension();
				$image->move('public/uploads/gallery', $new_image);
				$gallery = new Gallery();
				$gallery->gallery_name = $new_image;
				$gallery->gallery_image = $new_image;
				$gallery->product_id = $productId;
				$gallery->save(); 
			}
		}
		Session::put('message', 'Thêm hình ảnh phụ thành công');
		return redirect()->back();
	}

	public function update_gallery_name(Request $request){
		$gal_id = $request->gal_id;
		$gal_text = $request->gal_text;
		$gallery = Gallery::find($gal_id);
		$gallery->gallery_name = $gal_text;
		$gallery->save(); 
	}

	public function delete_gallery(Request $request){
		$gal_id = $request->gal_id;
		$gallery = Gallery::find($gal_id);
		unlink('public/uploads/gallery/'.$gallery->gallery_image);
		$gallery->delete();
	}
}