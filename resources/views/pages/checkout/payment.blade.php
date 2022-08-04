@extends('layout')

@section('title')
    <title>Thanh toán giỏ hàng| MobileShop</title>
@endsection

@section('content')
    <section id="cart_items">
        <div class="container" style="width: 100%">
            <div class="breadcrumbs">
                <ol class="breadcrumb" style="margin-bottom: 0">
                    <li><a href="#">Trang chủ</a></li>
                    <li class="active">Thanh toán giỏ hàng</li>
                </ol>
            </div>

            <div class="review-payment">
                <h2>Các sản phẩm trong giỏ hàng</h2>
                <div class="table-responsive cart_info">
                    <?php
                    $content = Cart::content();
                    
                    ?>
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">Hình ảnh</td>
                                <td class="description">Tên sản phẩm</td>
                                <td class="price">Giá</td>
                                <td class="quantity">Số lượng</td>
                                <td class="total">Tổng tiền</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($content as $v_content)
                                <tr>
                                    <td class="cart_product">
                                        <a href="">
                                            <img src="{{ URL::to('public/uploads/product/' . $v_content->options->image) }}"
                                                alt="" style="width: 50px">
                                        </a>
                                    </td>
                                    <td class="cart_description">
                                        <h4><a href="">{{ $v_content->name }}</a></h4>
                                        {{-- <p>Web ID: 1089772</p> --}}
                                    </td>
                                    <td class="cart_price">
                                        <p>{{ number_format($v_content->price, 0, ',', '.') }} VNĐ</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            <form action="{{ URL::to('/update-cart-quantity') }}" method="POST">
                                                {{ csrf_field() }}
                                                <input class="cart_quantity_input" type="text" name="cart_quantity"
                                                    value="{{ $v_content->qty }}" size="1">
                                                <input type="hidden" name="rowId_cart" value={{ $v_content->rowId }}
                                                    class="form-control">
                                                {{-- <input type="submit" name="update_qty" value="Cập nhật"
                                                    class="btn btn-default btn-sm"> --}}
                                            </form>
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">
                                            @php
                                                $subtotal = $v_content->price * $v_content->qty;
                                                echo number_format($subtotal, 0, ',', '.') . ' VNĐ';
                                            @endphp
                                        </p>
                                    </td>
                                    {{-- <td class="cart_delete">
                                        <a class="cart_quantity_delete"
                                            href="{{ URL::to('/delete-to-cart/' . $v_content->rowId) }}"><i
                                                class="fa fa-times"></i></a>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <h2>Tổng chi phí</h2>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="total_area">
                            <ul style="padding-left: unset">
                                <li>Tổng <span>{{ Cart::priceTotal(0, ',', '.') . ' ' . 'VNĐ' }}</span></li>
                                <li>Thuế <span>{{ Cart::tax(0, ',', '.') . ' ' . 'VNĐ' }}</span></li>
                                <li>Phí vận chuyển <span>Free</span></li>
                                <li>Thành tiền <span>{{ Cart::total(0, ',', '.') . ' ' . 'VNĐ' }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="custom-h2">Chọn hình thức thanh toán</h2>
            <form action="{{ URL::to('/order-place') }}" method="POST">
                {{ csrf_field() }}
                <div class="payment-options" style="margin-block: unset">
                    <span>
                        <label><input type="radio" name="payment_option" value="1" disabled> Thanh toán bằng thẻ
                            ATM</label>
                    </span>
                    <span>
                        <label><input type="radio" name="payment_option" value="2" required> Thanh toán tiền mặt khi
                            nhận
                            hàng</label>
                    </span>
                    <span>
                        <label><input type="radio" name="payment_option" value="3" disabled> Sử dụng thẻ ghi
                            nợ</label>
                    </span>
                </div>
                <input type="submit" value="Xác nhận & đặt hàng" name="send_order"
                    class="btn btn-primary btn-sm custom-order-btn" style="margin-block: 40px; padding-block: 12px;">

            </form>
        </div>
    </section>
    <!--/#cart_items-->
@endsection
