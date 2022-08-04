@extends('admin_layout')
@section('admin_content')
    <div style="padding: 0 24px 48px 24px;">
        <h3>Thống kê đơn hàng</h3>
        <div class="row">
            <div class="col-md-3">
                <div class="custom-tk-box custom-tk-box-1 ">
                    <p>Tổng số đơn khách đã đặt</p>
                    <h2>{{ $order_unprocess + $order_success + $order_cancel }} </h2>
                </div>
            </div>

            <div class="col-md-3">
                <div class="custom-tk-box custom-tk-box-2">
                    <p>Số đơn hàng đã xác nhận</p>
                    <h2>{{ $order_success }} </h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="custom-tk-box custom-tk-box-3">
                    <p>Số đơn hàng chưa xử lý</p>
                    <h2>{{ $order_unprocess }} </h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="custom-tk-box custom-tk-box-4">
                    <p>Số đơn hàng đã hủy</p>
                    <h2>{{ $order_cancel }} </h2>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-4 col-md-offset-6">
                <canvas id="myChart"></canvas>
            </div>
        </div> --}}
        <input type="hidden" class="hidden-product-dash" value='{{ $sold_count }}'>
        <input type="hidden" class="hidden-product-dash" value='{{ $warehouse }}'>


        <div class="row" style="margin-top: 30px; text-align:center">
            <div class="col-md-3">
                <h4 style="margin-bottom: 20px">Số lượng sản phẩm đã bán</h4>

                <canvas id="myChart"></canvas>
                <div class="custom-product-count">
                    <p>Tổng số mặt hàng:</p>
                    <span>
                        {{ $product_count }}
                    </span>
                </div>
            </div>
            <div class="col-md-4">
                <h4 style="margin-bottom: 20px">Số lượng sản phẩm theo thương hiệu</h4>
                <canvas id="myBrandQty"></canvas>
            </div>
            <div class="col-md-4">
                <h4 style="margin-bottom: 20px">Số lượng sản phẩm theo danh mục</h4>
                <canvas id="myCategoryQty"></canvas>
            </div>
        </div>

        @php
            
            foreach ($brand as $item => $brd) {
                $quaty = 0;
                foreach ($product as $item => $prd) {
                    if ($brd->brand_id == $prd->brand_id) {
                        $quaty += $prd->product_quantity;
                    }
                }
                echo '<input type="hidden" class="hidden-brand-qty" data-brandname="'.$brd->brand_name.'" data-brandqty="'.$quaty.'">';
            }
            foreach ($category as $item => $ctg) {
                $quatys = 0;
                foreach ($product as $item => $prd) {
                    if ($ctg->category_id == $prd->category_id) {
                        $quatys += $prd->product_quantity;
                    }
                }
                echo '<input type="hidden" class="hidden-category-qty" data-categoryname="'.$ctg->category_name.'" data-categoryqty="'.$quatys.'">';
            }
            
        @endphp

    </div>
@endsection
