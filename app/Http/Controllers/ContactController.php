<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Brand;
use App\CategoryProduct;
use App\Contact;

use Auth;

session_start();

class ContactController extends Controller
{
    public function AuthLogin() {
		$admin_id = Auth::id();
		if ($admin_id) {
			return Redirect::to('dashboard');
		} else {
			return Redirect::to('login-auth')->send();
		}
	}
    public function contact(){
		$category = CategoryProduct::where('category_status', '1')
		->orderby('category_id', 'desc')->get();
        $contact = Contact::where('contact_status', '1')->orderby('contact_id', 'asc')->get();

		$brand = Brand::all();
		$brand_data = array();
		$brand_data_id = array();
		foreach ($brand as $key => $br) {
			array_push($brand_data, $br->brand_name);
			array_push($brand_data_id, $br->brand_id);
		}
		return view('pages.contact.contact')->with(compact('category', 'brand', 'brand_data', 'brand_data_id', 'contact'));
	}

    public function add_contact(){
		$this->AuthLogin();

		return view('admin.contact.add_contact');
    }

    public function edit_contact($contactId){
		$this->AuthLogin();
        $contact = Contact::where('contact_id', $contactId)->first();

		return view('admin.contact.edit_contact')->with(compact('contact'));

    }

    public function all_contact(){
		$this->AuthLogin();
        $contact = Contact::orderby('contact_id', 'asc')->get();

		return view('admin.contact.all_contact')->with(compact('contact'));
    
    }

    public function delete_contact($contactId){
        $this->AuthLogin();

        $contact = Contact::find($contactId);
        $contact->delete();
        Session::put('message','Xóa thông tin liên hệ thành công');
        return redirect()->back();
    }

    public function save_contact(Request $request){
        $data = $request->all();

		$contact = new Contact();
		$contact->contact_title = $data['contact_title'];
		$contact->contact_content = $data['contact_content'];
		$contact->contact_status = $data['contact_status'];
		$contact->save();

		Session::put('message', 'Thêm thông tin liên hệ thành công');
		return Redirect::to('all-contact');
    
    }

    public function update_contact(Request $request, $contactId){
        $data = $request->all();

		$contact = Contact::find($contactId);
		$contact->contact_title = $data['contact_title'];
		$contact->contact_content = $data['contact_content'];
		$contact->contact_status = $data['contact_status'];
		$contact->save();

		Session::put('message', 'Cập nhật thông tin liên hệ thành công');
		return Redirect::to('all-contact');
    }

    public function enale_contact($contactId){
        $this->AuthLogin();
        $contact = Contact::where('contact_id', $contactId)->update(['contact_status'=>1]);
        Session::put('message','Hiển thị nội dung thành công');
        return Redirect::to('all-contact');
    }

    public function disable_contact($contactId){
        $this->AuthLogin();
        $contact = Contact::where('contact_id', $contactId)->update(['contact_status'=>0]);
        Session::put('message','Ẩn nội dung thành công');
        return Redirect::to('all-contact');
    }


}