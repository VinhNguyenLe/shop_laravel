<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use Mail;

session_start();

class MailController extends Controller
{
    public function send_mail(){
        //send mail
        $to_name = "Nguyen Le Vinh";
        $to_email = "levinhbn99@gmail.com";//send to this email

        $data = array("name"=>"Mail từ tài khoản khách hàng","body"=>"Mail về vấn đề sản phẩm"); //body of mail.blade.php
    
        Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('test mail nhé');//send this mail with subject
            $message->from($to_email,$to_name);//send from this mail
        });
        // return Redirect('/')->with('message', '');

//--send mail
    }
    public function mail(){
        return view('pages.mail.mail_order');
    }
}