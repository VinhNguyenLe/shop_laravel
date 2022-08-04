@extends('layout')
@section('title')
    <title>Giỏ hàng | MobileShop</title>
@endsection

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb" style="margin-bottom: 12px">
                    <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
                    <li class="active">Giỏ hàng</li>
                </ol>
            </div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {!! session()->get('message') !!}
                </div>
            @elseif (session()->has('error'))
                <div class="alert alert-danger">
                    {!! session()->get('error') !!}
                </div>
            @endif
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
                                <td class="total">Giá</td>
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
                                        <td class="cart_product">
                                            <a href="{{ URL::to('/chi-tiet-san-pham/' . $cart['product_id']) }}"
                                                target="_blank">
                                                <img src="{{ asset('public/uploads/product/' . $cart['product_image']) }}"
                                                    alt="{{ $cart['product_name'] }}" style="width: 120px">
                                            </a>
                                        </td>
                                        <td class="cart_description">
                                            {{-- <h4><a href=""></a></h4> --}}
                                            <p>{{ $cart['product_name'] }}</p>
                                        </td>
                                        <td class="cart_price">
                                            {{-- <p>{{$cart['product_price']}}</p> --}}
                                            <p>{{ number_format($cart['product_price'], 0, ',', '.') }} VNĐ</p>
                                        </td>
                                        <td class="cart_quantity">
                                            <div class="cart_quantity_button">
                                                {{ csrf_field() }}
                                                <input class="cart_quantity_input" type="number" min="1"
                                                    name="cart_qty[{{ $cart['session_id'] }}]"
                                                    value="{{ $cart['product_qty'] }}" size="1">
                                                {{-- <input type="hidden" name="rowId_cart" value="" class="form-control"> --}}

                                            </div>
                                        </td>
                                        <td class="cart_total">
                                            <p class="cart_total_price">
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
                                    <td>
                                        <ul style="padding-inline-start: 24px">
                                            <li>Tổng giá tiền: <span>
                                                    {{ number_format($total, 0, ',', '.') }} VNĐ
                                                </span></li>
                                            {{-- <li>Thuế: <span></span></li>
                                            <li>Phí vận chuyển: <span>Free</span></li> --}}
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
                                                            <span>
                                                <li>Chi phí sau khi giảm
                                                    :{{ number_format($total - $total_coupon, 0, ',', '.') }} VNĐ</li>
                                                </span>
                                            @elseif($cou['coupon_condition'] == 2)
                                                Mã {{ $cou['coupon_code'] }} giảm:
                                                {{ number_format($cou['coupon_number'], 0, ',', '.') }} VNĐ
                                                @php
                                                    $total_coupon = $total - $cou['coupon_number'];
                                                    
                                                @endphp
                                                <span>
                                                    <li>Chi phí sau khi giảm:
                                                        {{ number_format($total_coupon, 0, ',', '.') }} VNĐ
                                                    </li>
                                                </span>
                                            @endif
                            @endforeach



                            </li>
                            @endif

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
                                <td colspan="5" style="text-align: center; padding: 40px">
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
                    {{-- <form action="{{ URL::to('/check-coupon') }}" method="POST">
                        @csrf
                        <input type="text" class="custom-input-primary" name="coupon" placeholder="Nhập mã khuyến mãi">
                        <input type="submit" class="btn btn-default custom-btn-primary check_coupon" name="check_coupon"
                            value="Sử dụng mã">

                        @if (Session::get('coupon'))
                            <a class="btn btn-default custom-btn-primary" href="{{ URL::to('/unset-coupon') }}">Hủy mã
                                khuyến
                                mãi</a>
                        @endif

                    </form> --}}
                    <div style="margin-top: 30px">
                        @if (Session::get('customer_id'))
                            <a class="btn btn-default custom-btn-second" href="{{ URL::to('/checkout') }}">Đặt hàng</a>
                        @else
                            <a class="btn btn-default custom-btn-second" href="{{ URL::to('/login-checkout') }}">Đăng
                                nhập
                                để đặt hàng</a>
                        @endif
                    </div>

                </div>
            @endif
        </div>
    </section>

@endsection
