@extends('layout')

@section('title')
    <title>Chi tiết đơn hàng</title>
@endsection

@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading" style="font-size: 20px">
                Người đặt hàng
            </div>
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

            <div class="table-responsive">

                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Tên tài khoản</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $customer->customer_name }}</td>
                            <td>{{ $customer->customer_phone }}</td>
                            <td>{{ $customer->customer_email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <br />

    {{-- Thông tin vận chuyển --}}
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading" style="font-size: 20px">
                Người nhận hàng
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">

                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">

                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Người nhận hàng</th>
                            <th>Địa chỉ nhận hàng</th>
                            <th>Số điện thoại</th>
                            <th>Phương thức thanh toán</th>
                            <th>Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $shipping->shipping_name }}</td>
                            <td>{{ $shipping->shipping_address }}</td>
                            <td>{{ $shipping->shipping_phone }}</td>
                            <td>
                                @if ($shipping->shipping_method == 0)
                                    Chuyển khoản
                                @else
                                    Thanh toán khi nhận hàng
                                @endif
                            </td>
                            <td>
                                @if ($shipping->shipping_notes == 'Ghi chú...')
                                    Không
                                @else
                                    {{ $shipping->shipping_notes }}
                                @endif

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <br />
    {{-- Đơn hàng --}}
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading" style="font-size: 20px">
                Đơn hàng
            </div>

            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th style="width:20px">STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng kho</th>
                            <th>Số lượng đặt</th>
                            <th>Mã giảm giá</th>
                            <th>Giá sản phẩm</th>
                            <th>Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                            $total = 0;
                        @endphp
                        @foreach ($order_details_product as $key => $details)
                            @php
                                $i++;
                                $subtotal = $details->product_price * $details->product_sales_quantity;
                                $total += $subtotal;
                            @endphp
                            <tr class="color_qty_{{ $details->product_id }}">

                                <td>{{ $i }}</td>
                                <td>{{ $details->product_name }}</td>
                                <td>{{ $details->product->product_quantity }}</td>
                                <td> {{ $details->product_sales_quantity }}</td>
                                <td>
                                    @if ($details->product_coupon != 'no')
                                        {{ $details->product_coupon }}
                                    @else
                                        Không
                                    @endif
                                </td>
                                <td> {{ number_format($details->product_price, 0, ',', '.') }} VNĐ</td>
                                <td> {{ number_format($subtotal, 0, ',', '.') }}
                                    VNĐ</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2">
                                <a href="{{ URL::to('/print-order/' . $details->order_code) }}" class="btn btn-success">In
                                    đơn
                                    hàng</a>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                @php
                                    $total_coupon = 0;
                                @endphp
                                @if ($coupon_condition == 1)
                                    @php
                                        $total_after_coupon = ($total * $coupon_number) / 100;
                                        echo 'Tổng giảm :' . number_format($total_after_coupon, 0, ',', '.') . ' VNĐ' . '</br>';
                                        $total_coupon = $total + $details->product_feeship - $total_after_coupon;
                                    @endphp
                                @else
                                    @php
                                        echo 'Tổng giảm :' . number_format($coupon_number, 0, ',', '.') . ' VNĐ' . '</br>';
                                        $total_coupon = $total + $details->product_feeship - $coupon_number;
                                        
                                    @endphp
                                @endif

                                Phí vận chuyển : {{ number_format($details->product_feeship, 0, ',', '.') }} VNĐ
                                <br />
                                Thanh toán: {{ number_format($total_coupon, 0, ',', '.') }} VNĐ
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <br />
@endsection
