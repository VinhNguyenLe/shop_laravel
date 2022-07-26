@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tài khoản đặt hàng
            </div>

            <div class="table-responsive">
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
            <div class="panel-heading">
                Thông tin người nhận hàng
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
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<div class="alert alert-success">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    									  <strong>Thông báo:</strong> ' .
                        $message .
                        '
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    									</div>';
                    Session::put('message', null);
                }
                ?>
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
            <div class="panel-heading">
                Đơn hàng
            </div>

            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<div class="alert alert-success">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    									  <strong>Thông báo:</strong> ' .
                        $message .
                        '
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    									</div>';
                    Session::put('message', null);
                }
                ?>
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
                                <td>

                                    <input type="number" min="1" {{ $order_status != 1 ? 'disabled' : '' }}
                                        style="width: 30px"
                                        class="custom-input-unarrow custom-input order_qty_{{ $details->product_id }}"
                                        value="{{ $details->product_sales_quantity }}" name="product_sales_quantity">

                                    {{-- Hidden --}}
                                    <input type="hidden" name="order_qty_storage"
                                        class="order_qty_storage_{{ $details->product_id }}"
                                        value="{{ $details->product->product_quantity }}">
                                    <input type="hidden" name="order_code" class="order_code"
                                        value="{{ $details->order_code }}">
                                    <input type="hidden" name="order_product_id" class="order_product_id"
                                        value="{{ $details->product_id }}">
                                    {{-- EndHidden --}}
                                    @if ($order_status == 1)
                                        <button class="custom-btn btn-success update_quantity_order"
                                            data-product_id="{{ $details->product_id }}" name="update_quantity_order">Cập
                                            nhật</button>
                                    @endif
                                </td>
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
                        <tr>
                            <td></td>
                            <td>
                                <p>Xác nhận đơn hàng:</p>
                            </td>
                            <td colspan="3">
                                @foreach ($order as $key => $or)
                                    @if ($or->order_status == 1)
                                        <form>
                                            @csrf
                                            <select class="form-control order_details">
                                                <option value="">----Chọn hình thức đơn hàng-----</option>
                                                <option id="{{ $or->order_id }}" selected value="1">Chưa xử lý
                                                </option>
                                                <option id="{{ $or->order_id }}" value="2">Đã xử lý - Đã giao hàng
                                                </option>
                                                <option id="{{ $or->order_id }}" value="3">Hủy đơn hàng - Tạm giữ
                                                </option>
                                            </select>
                                        </form>
                                    @elseif($or->order_status == 2)
                                        <form>
                                            @csrf
                                            <select class="form-control order_details">
                                                <option value="">----Chọn hình thức đơn hàng-----</option>
                                                <option id="{{ $or->order_id }}" value="1">Chưa xử lý</option>
                                                <option id="{{ $or->order_id }}" selected value="2">Đã xử lý - Đã giao
                                                    hàng</option>
                                                <option id="{{ $or->order_id }}" value="3">Hủy đơn hàng - Tạm giữ
                                                </option>
                                            </select>
                                        </form>
                                    @else
                                        <form>
                                            @csrf
                                            <select class="form-control order_details">
                                                <option value="">----Chọn hình thức đơn hàng-----</option>
                                                <option id="{{ $or->order_id }}" value="1">Chưa xử lý</option>
                                                <option id="{{ $or->order_id }}" value="2">Đã xử lý - Đã giao hàng
                                                </option>
                                                <option id="{{ $or->order_id }}" selected value="3">Hủy đơn hàng - Tạm
                                                    giữ</option>
                                            </select>
                                        </form>
                                    @endif
                                @endforeach
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <br />
    {{-- @endforeach --}}
@endsection
