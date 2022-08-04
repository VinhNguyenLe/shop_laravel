@extends('layout')

@section('title')
    <title>Đăng nhập | MobileShop</title>
@endsection

@section('content')
    <div class=" padding-right">

        <section id="form" style="margin-top: unset">
            <!--form-->
            <div class="container">
                <div class="row">
                    <div class="custom-login-register-wrap">
                        <div class="col-sm-5 custom-login-customer-form active">
                            <div class="login-form custom-login-customer">
                                <!--login form-->
                                <h2>Đăng nhập tài khoản</h2>
                                <?php
                                $message = Session::get('message');
                                $error = Session::get('error');
                                if ($message) {
                                    echo '<div class="alert alert-success">' . $message . '</div>';
                                    Session::put('message', null);
                                } elseif ($error) {
                                    echo '<div class="alert alert-danger">' . $error . '</div>';
                                    Session::put('error', null);
                                }
                                ?>
                                <form action="{{ URL::to('/login-customer') }}" method="POST" class="form-login-cus">
                                    {{ csrf_field() }}

                                    <input type="email" name="email_account" placeholder="Email" />
                                    <input type="password" name="password_account" placeholder="Mật khẩu" />

                                    <button type="submit" class="btn btn-default custom-btn-trans">Đăng nhập</button>
                                    <p>Bạn chưa có tài khoản? Đăng ký</p>
                                </form>
                            </div>
                            <!--/login form-->
                        </div>

                        <div class="col-sm-5 custom-register-customer-form">
                            <div class="login-form custom-login-customer">
                                <!--sign up form-->
                                <h2>Đăng ký tài khoản mới</h2>
                                <form action="{{ URL::to('/add-customer') }}" method="POST" class="form-res-cus">
                                    {{ csrf_field() }}
                                    <input type="text" name="customer_name" placeholder="Họ và tên" required />
                                    <input type="email" name="customer_email" placeholder="Địa chỉ email" required />
                                    <input type="password" name="customer_password" class="customer_password"
                                        placeholder="Mật khẩu" required />

                                    <input type="phone" name="customer_phone" placeholder="Số điện thoại" required />
                                    {{-- <input type="password" name="customer_" placeholder="Password"/> --}}
                                    <button type="submit" class="btn btn-default custom-btn-trans"
                                        id="customer-from-res">Đăng
                                        ký</button>
                                    <p>Bạn đã có tài khoản? Đăng nhập</p>

                                </form>
                            </div>
                            <!--/sign up form-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/form-->
    </div>
@endsection
