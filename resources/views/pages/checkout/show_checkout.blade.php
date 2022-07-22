@extends('layout')

@section('title')
    <title>Thanh toán | E-Shopper</title>
@endsection

@section('content')

    <section id="cart_items">
        <div class="container" style="width: 100%; ">
            <div class="breadcrumbs" style="margin-bottom: 30px;">
                <ol class="breadcrumb" style="margin-bottom: 0">
                    <li><a href="#">Trang chủ</a></li>
                    <li class="active">Đơn hàng</li>
                </ol>
            </div>
            <!--/breadcrums-->


            @if (!session()->has('customer_id'))
                <div class="register-req">
                    <p>Hãy sử dụng tài khoản để thanh toán giỏ hàng và xem lịch sử mua hàng dễ dàng hơn!</p>
                </div>
            @endif

            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @elseif (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <!--/register-req-->

            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-6 clearfix">

                        <div class="bill-to">
                            <div class="form-one custom-form-1 " style="width: 100%">
                                {{-- <form action="{{ URL::to('/save-checkout-customer') }}" method="POST"> --}}
                                <form method="POST">
                                    {{ csrf_field() }}
                                    <h3>Thông tin đặt hàng</h3>

                                    <div class="form-group">
                                        <label>Người nhận hàng:</label>
                                        <input type="text" name="shipping_name" class="form-control shipping_name"
                                            placeholder="Họ và tên người nhận">
                                    </div>
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="text" name="shipping_email" class="form-control shipping_email"
                                            placeholder="Điền email">
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ nhận hàng:</label>
                                        <input type="text" name="shipping_address" class="form-control shipping_address"
                                            placeholder="Địa chỉ nhận hàng">
                                    </div>
                                    <div class="form-group">
                                        <label>Số điện thoại của bạn:</label>
                                        <input type="text" name="shipping_phone" class="form-control shipping_phone"
                                            placeholder="Số điện thoại">
                                    </div>

                                    @if (Session::get('fee'))
                                        <input type="hidden" name="order_fee" class="order_fee"
                                            value="{{ Session::get('fee') }}">
                                    @else
                                        <input type="hidden" name="order_fee" class="order_fee" value="10000">
                                    @endif

                                    @if (Session::get('coupon'))
                                        @foreach (Session::get('coupon') as $key => $cou)
                                            <input type="hidden" name="order_coupon" class="order_coupon"
                                                value="{{ $cou['coupon_code'] }}">
                                        @endforeach
                                    @else
                                        <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                                    @endif

                                    <div class="form-group">
                                        <label>Ghi chú của bạn:</label>
                                        <textarea name="shipping_notes" class="form-control shipping_notes" placeholder="Ghi chú đơn hàng của bạn"
                                            rows="3">Ghi chú...</textarea>

                                    </div>
                                    <div class="">
                                        <div class="form-group">
                                            <label>Chọn hình thức thanh toán</label>
                                            <select name="payment_select"
                                                class="form-control input-sm m-bot15 payment_select">
                                                <option value="0">Qua chuyển khoản</option>
                                                <option value="1">Tiền mặt</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="button" value="Xác nhận đơn hàng" name="send_order"
                                        class="btn btn-primary btn-sm send_order">
                                </form>

                            </div>

                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="bill-to">
                            <form>
                                @csrf
                                <h3>Thông tin đặt hàng</h3>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn thành phố</label>
                                    <select name="city" id="city" class="form-control input-sm m-bot15 choose city">

                                        <option value="">--Chọn tỉnh thành phố--</option>
                                        @foreach ($city as $key => $ci)
                                            <option value="{{ $ci->matp }}">{{ $ci->name_city }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn quận huyện</label>
                                    <select name="province" id="province"
                                        class="form-control input-sm m-bot15 province choose">
                                        <option value="">--Chọn quận huyện--</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn xã phường</label>
                                    <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                        <option value="">--Chọn xã phường--</option>
                                    </select>
                                </div>


                                <input type="button" value="Tính phí vận chuyển" name="calculate_order"
                                    class="btn btn-default custom-btn-primary calculate_delivery">
                            </form>
                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-12 clearfix">
                        <h3>Sản phẩm đã lựa chọn</h3>
                        <div class="table-responsive cart_info" style="margin-bottom: 30px">
                            <table class="table table-condensed">
                                <form action="{{ URL::to('update-cart-ajax') }}" method="POST">
                                    @csrf
                                    <thead>
                                        <tr class="cart_menu">
                                            <td class="image">Hình ảnh</td>
                                            <td class="description">Tên sản phẩm</td>
                                            <td class="price">Giá</td>
                                            <td class="quantity">Số lượng</td>
                                            <td class="total">Thành tiền</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (Session::get('cart') == true)
                                            @php
                                                $total = 0;
                                                
                                            @endphp

                                            @foreach (Session::get('cart') as $key => $cart)
                                                @php
                                                    $subtotal = $cart['product_price'] * $cart['product_qty'];
                                                    $total += $subtotal;
                                                @endphp

                                                <tr>
                                                    <td class="cart_product" style="margin: 12px">
                                                        <a href="{{ URL::to('/chi-tiet-san-pham/' . $cart['product_id']) }}"
                                                            target="_blank">
                                                            <img src="{{ asset('public/uploads/product/' . $cart['product_image']) }}"
                                                                alt="{{ $cart['product_name'] }}" style="width: 120px">
                                                        </a>
                                                    </td>
                                                    <td class="cart_description">
                                                        <p>{{ $cart['product_name'] }}</p>
                                                    </td>
                                                    <td class="cart_price">
                                                        <p style="font-size: 16px">
                                                            {{ number_format($cart['product_price'], 0, ',', '.') }} VNĐ
                                                        </p>
                                                    </td>
                                                    <td class="cart_quantity">
                                                        <div class="cart_quantity_button">
                                                            {{ csrf_field() }}
                                                            <input class="cart_quantity_input custom-input-primary"
                                                                type="number" min="1"
                                                                name="cart_qty[{{ $cart['session_id'] }}]"
                                                                value="{{ $cart['product_qty'] }}" size="1"
                                                                style="width: 50px; padding-inline: 0">

                                                        </div>
                                                    </td>
                                                    <td class="cart_total">
                                                        <p class="cart_total_price" style="font-size: 20px">
                                                            {{ number_format($subtotal, 0, ',', '.') }} VNĐ

                                                        </p>
                                                    </td>
                                                    <td class="cart_delete">
                                                        <a class="cart_quantity_delete"
                                                            href="{{ URL::to('/delete-product-ajax/' . $cart['session_id']) }}"><i
                                                                class="fa fa-times"></i></a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="5">
                                                    <ul style="padding-inline-start: 24px">
                                                        <li>Tổng giá tiền: <span>
                                                                {{ number_format($total, 0, ',', '.') }} VNĐ
                                                            </span></li>
                                                        @if (Session::get('coupon'))
                                                            <li>
                                                                @foreach (Session::get('coupon') as $key => $cou)
                                                                    @if ($cou['coupon_condition'] == 1)
                                                                        Mã {{ $cou['coupon_code'] }} giảm:
                                                                        {{ $cou['coupon_number'] }}%
                                                                        <span>
                                                                            @php
                                                                                $total_coupon = ($total * $cou['coupon_number']) / 100;
                                                                                echo '<span><li>Số tiền được giảm: ' . number_format($total_coupon, 0, ',', '.') . ' VNĐ</li></span>';
                                                                            @endphp
                                                                        </span>
                                                                        {{-- <span>
                                                            <li>Chi phí sau khi giảm
                                                                :{{ number_format($total - $total_coupon, 0, ',', '.') }}
                                                                VNĐ</li>
                                                            </span> --}}
                                                                        <span>
                                                                            @php
                                                                                $total_after_coupon = $total - $total_coupon;
                                                                            @endphp
                                                                        </span>
                                                                    @elseif ($cou['coupon_condition'] == 2)
                                                                        Mã {{ $cou['coupon_code'] }} giảm:
                                                                        {{ number_format($cou['coupon_number'], 0, ',', '.') }}
                                                                        VNĐ
                                                                        @php
                                                                            $total_after_coupon = $total - $cou['coupon_number'];
                                                                            
                                                                        @endphp
                                                                        {{-- <span>
                                                                <li>Chi phí sau khi giảm:
                                                                    {{ number_format($total_coupon, 0, ',', '.') }} VNĐ
                                                                </li>
                                                            </span> --}}
                                                                    @endif
                                                                @endforeach
                                                            </li>



                                                            </li>
                                                        @endif
                                                        @if (Session::get('fee'))
                                                            <li>
                                                                <a class="cart_quantity_delete"
                                                                    href="{{ url('/delete-fee') }}"><i
                                                                        class="fa fa-times"></i></a>

                                                                Phí vận chuyển
                                                                <span>{{ number_format(Session::get('fee'), 0, ',', '.') }}
                                                                    VNĐ</span>
                                                            </li>
                                                            <?php $total_after_fee = $total + Session::get('fee'); ?>
                                                        @endif
                                                        <li>Tổng còn:
                                                            @php
                                                                if (Session::get('fee') && !Session::get('coupon')) {
                                                                    $total_after = $total_after_fee;
                                                                    echo number_format($total_after, 0, ',', '.') . 'đ';
                                                                } elseif (!Session::get('fee') && Session::get('coupon')) {
                                                                    $total_after = $total_after_coupon;
                                                                    echo number_format($total_after, 0, ',', '.') . 'đ';
                                                                } elseif (Session::get('fee') && Session::get('coupon')) {
                                                                    $total_after = $total_after_coupon;
                                                                    $total_after = $total_after + Session::get('fee');
                                                                    echo number_format($total_after, 0, ',', '.') . 'đ';
                                                                } elseif (!Session::get('fee') && !Session::get('coupon')) {
                                                                    $total_after = $total;
                                                                    echo number_format($total_after, 0, ',', '.') . 'đ';
                                                                }
                                                                
                                                            @endphp
                                                        </li>

                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" style="padding-left: 24px">
                                                    <input type="submit" name="update_qty" value="Cập nhật giỏ hàng"
                                                        class="btn btn-default custom-btn-primary ">
                                                    <a class="btn btn-default custom-btn-primary "
                                                        href="{{ URL::to('/delete-all-product-ajax') }}">Xóa
                                                        tất cả sản phẩm</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                {{-- <td colspan="5" style="padding-left: 24px; display: flex"> --}}
                                                {{-- <a href="" class="btn btn-default custom-btn-primary ">Thanh toán</a> --}}

                                                {{-- </td> --}}
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="5" style="text-align: center">
                                                    Giỏ hàng rỗng
                                                </td>
                                            <tr>
                                        @endif
                                    </tbody>


                                </form>
                            </table>

                        </div>
                        @if (Session::get('cart'))
                            <div class="coupon-wrap">
                                <form action="{{ URL::to('/check-coupon') }}" method="POST">
                                    @csrf
                                    <input type="text" class="custom-input-primary" name="coupon"
                                        placeholder="Nhập mã khuyến mãi">
                                    <input type="submit" class="btn btn-default custom-btn-primary check_coupon"
                                        name="check_coupon" value="Sử dụng mã">
                                    @if (Session::get('coupon'))
                                        <a class="btn btn-default custom-btn-primary"
                                            href="{{ URL::to('/unset-coupon') }}">Hủy mã
                                            khuyến
                                            mãi</a>
                                    @endif
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>


        </div>
    </section>
    <!--/#cart_items-->
@endsection
