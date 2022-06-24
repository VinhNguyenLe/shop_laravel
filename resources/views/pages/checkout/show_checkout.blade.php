@extends('layout')

@section('title')
    <title>Thanh toán | E-Shopper</title>
@endsection

@section('content')

    <section id="cart_items">
        <div class="container" style="width: 100%">
            <div class="breadcrumbs">
                <ol class="breadcrumb" style="margin-bottom: 0">
                    <li><a href="#">Trang chủ</a></li>
                    <li class="active">Đơn hàng</li>
                </ol>
            </div>
            <!--/breadcrums-->


            <div class="register-req">
                <p>Hãy sử dụng tài khoản để thanh toán giỏ hàng và xem lịch sử mua hàng dễ dàng hơn!</p>
            </div>
            <!--/register-req-->

            <div class="shopper-informations">
                <div class="row">

                    <div class="col-sm-10 clearfix">
                        <div class="bill-to">
                            <div class="form-one">
                                <form action="{{ URL::to('/save-checkout-customer') }}" method="POST">
                                    {{ csrf_field() }}
                                    <p>Thông tin đặt hàng</p>
                                    <input type="text" name="shipping_name" placeholder="Họ và tên" required>
                                    <input type="email" name="shipping_email" placeholder="Email" required>
                                    <input type="text" name="shipping_address" placeholder="Bạn vui lòng ghi rõ địa chỉ nơi nhận hàng nhé!" required>
                                    <input type="text" name="shipping_phone" placeholder="Số điện thoại" required>
                                    <p>Ghi chú về đơn hàng</p>
									<h5 class="text-muted">*Nếu bạn có yêu cầu hay mong muốn gì về đơn hàng, hãy điền tại đây</h5>
                                    <textarea name="shipping_notes" placeholder="Nếu bạn có yêu cầu hay mong muốn gì về đơn hàng, hãy điền tại đây" rows="16">Ghi chú</textarea>
                                    <input type="submit" value="Xác nhận" name="send_order"
                                        class="btn btn-primary btn-sm custom-order-btn">
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            {{-- <div class="review-payment">
                <h2>Các sản phẩm trong giỏ hàng</h2>
            </div> --}}


            {{-- <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div> --}}
        </div>
    </section>
    <!--/#cart_items-->
@endsection
