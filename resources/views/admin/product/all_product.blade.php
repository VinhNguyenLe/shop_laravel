@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê sản phẩm
            </div>
            <div class="row w3-res-tb">

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
                            <th style="width:20px;">
                                STT
                            </th>
                            <th>Tên sản phẩm</th>
                            <th>Giá sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Danh mục</th>
                            <th>Thương hiệu</th>
                            <th>Hình ảnh</th>
                            <th>Hiển thị</th>
                            <th>HĐ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($all_product as $key => $pro)
                            <tr>
                                @php
                                    $i++;
                                @endphp
                                <td>{{ $i }} </td>
                                <td>{{ $pro->product_name }}</td>
                                <td>{{ number_format($pro->product_price) }} VNĐ</td>
                                <td>{{ $pro->product_quantity }}</td>
                                <td>{{ $pro->category_name }}</td>
                                <td>{{ $pro->brand_name }}</td>
                                <td><img src="public/uploads/product/{{ $pro->product_image }}" width="100"></td>
                                <td><span class="text-ellipsis">
                                        @if ($pro->product_status == 0)
                                            <a href="{{ URL::to('/active-product/' . $pro->product_id) }}">
                                                <span class="fa fa-eye-slash fa-thumb-styling"
                                                    title="Chọn để hiển thị"></span>
                                            </a>'
                                        @else
                                            <a href="{{ URL::to('/unactive-product/' . $pro->product_id) }}">
                                                <span class="fa fa-eye fa-thumb-styling" title="Chọn để ẩn"></span>
                                            </a>
                                        @endif

                                    </span></td>
                                <td>
                                    <a href="{{ URL::to('/edit-product/' . $pro->product_id) }}" class="active styling-edit"
                                        ui-toggle-class="" title="Sửa sản phẩm">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </a>
                                    <a href="{{ URL::to('/delete-product/' . $pro->product_id) }}"
                                        class="active styling-edit" ui-toggle-class="" title="Xóa sản phẩm"
                                        onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')">
                                        <i class="fa fa-times text-danger text"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <form action="{{ url('/export-product-csv') }}" method="POST" style="padding: 20px">
                @csrf
                <input type="submit" value="Tải xuống file Excel" name="export_csv" class="btn btn-success">
            </form>
        </div>
    </div>
@endsection
