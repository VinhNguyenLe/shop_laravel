@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm mã giảm giá
                </header>
                <div class="panel-body">

                    <div class="position-center">
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
                        <form role="form" method="post" action="{{ URL::to('/insert-coupon-code') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="coupon-name">Tên mã giảm giá</label>
                                <input type="text" class="form-control" id="coupon-name" name="coupon_name">
                            </div>
                            <div class="form-group">
                                <label for="coupon-condition">Chọn hình thức giảm</label>
                                <select class="form-control input-sm m-bot15" name="coupon_condition">
                                    <option value="0">--Chọn hình thức giảm--</option>
                                    <option value="1">Giảm theo phần trăm</option>
                                    <option value="2">Giảm theo số tiền</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="coupon-keywords">Số tiền/Số phần trăm giảm của mã</label>
                                <input type="text" class="form-control" id="coupon-number" name="coupon_number">
                            </div>
                            <div class="form-group">
                                <label for="coupon-desc">Mã giảm giá</label>
                                <input type="text" class="form-control" id="coupon-code" name="coupon_code">
                            </div>
                            <div class="form-group">
                                <label for="coupon-time">Số lượng mã</label>
                                <input type="number" class="form-control" id="coupon-time" name="coupon_time"
                                    min="1">
                            </div>
                            {{-- <div class="form-group">
                                <label>Hiển thị?</label>
                                <select class="form-control input-sm m-bot15" name="coupon_status">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                </select>
                            </div> --}}
                            <button type="submit" class="btn btn-info" name="add_coupon">Thêm mã</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
