@extends('layout')
@section('title')
    <title>Giỏ hàng | E-Shopper</title>
@endsection

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
                    <li class="active">Giỏ hàng</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">

                <table class="table table-condensed">
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
                        @foreach(Session::get('cart') as $key => $cart)
                        <tr>
                            <td class="cart_product">
                                <a href="{{URL::to('/chi-tiet-san-pham/'.$cart['product_id'])}}" target="_blank">
                                    <img src="{{ asset('public/uploads/product/'.$cart['product_image']) }}"
                                        alt="{{$cart['product_name']}}" style="width: 120px">
                                </a>
                            </td>
                            <td class="cart_description">
                                {{-- <h4><a href=""></a></h4> --}}
                                <p>{{$cart['product_name']}}</p>
                            </td>
                            <td class="cart_price">
                                {{-- <p>{{$cart['product_price']}}</p> --}}
                                <p>{{number_format($cart['product_price'], 0, ',', '.')}} VNĐ</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <form action="" method="POST">
                                        {{ csrf_field() }}
                                        <input class="cart_quantity_input" type="text" name="cart_quantity" value=""
                                            size="1">
                                        <input type="hidden" name="rowId_cart" value="" class="form-control">
                                        <input type="submit" name="update_qty" value="Cập nhật"
                                            class="btn btn-default btn-sm">
                                    </form>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">

                                </p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!--/#cart_items-->
    <section id="do_action">
        <div class="container" style="width: 100%">
            <div class="heading">
                <h3>Chi phí thanh toán</h3>
            </div>
            <div class="row">

                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Tổng <span></span></li>
                            <li>Thuế <span></span></li>
                            <li>Phí vận chuyển <span>Free</span></li>
                            <li>Thành tiền <span></span></li>
                        </ul>

                        <a class="btn btn-default check_out" href="">Đặt hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#do_action-->
@endsection
