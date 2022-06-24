@extends('layout')

@section('title')
	<title>Đăng nhập | E-Shopper</title>
@endsection

@section('content')
<div class=" padding-right">
	
<section id="form" style="margin-top: unset"><!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-5">
				<div class="login-form"><!--login form-->
					<h2>Đăng nhập tài khoản</h2>
					<form action="{{URL::to('/login-customer')}}" method="POST">
						{{ csrf_field() }}

						<input type="email" name="email_account" placeholder="Email" />
						<input type="password" name="password_account" placeholder="Mật khẩu" />
						<span>
							<input type="checkbox" class="checkbox"> 
							Ghi nhớ đăng nhập?
						</span>
						<button type="submit" class="btn btn-default custom-btn-trans">Đăng nhập</button>
					</form>
				</div><!--/login form-->
			</div>
			<div class="col-sm-2">
				<h2 class="or" style="font-size: 14px">Hoặc</h2>
			</div>
			<div class="col-sm-5" >
				<div class="login-form"><!--sign up form-->
					<h2>Đăng ký tài khoản mới</h2>
					<form action="{{URL::to('/add-customer')}}" method="POST">
						{{ csrf_field() }}
						<input type="text" name="customer_name" placeholder="Họ và tên"/>
						<input type="email" name="customer_email" placeholder="Địa chỉ email"/>
						<input type="password" name="customer_password" placeholder="Mật khẩu"/>
						<input type="phone" name="customer_phone" placeholder="Số điện thoại"/>
						{{-- <input type="password" name="customer_" placeholder="Password"/> --}}
						<button type="submit" class="btn btn-default custom-btn-trans">Đăng ký</button>
					</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section><!--/form-->
</div>
@endsection