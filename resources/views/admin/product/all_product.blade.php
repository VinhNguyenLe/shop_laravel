@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                sản phẩm
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
                            <th>Giá gốc</th>
                            <th>Giá bán</th>
                            <th style="text-align: center">Số lượng</th>
                            <th style="text-align: center">Danh mục</th>
                            <th style="text-align: center">Thương hiệu</th>
                            <th style="text-align: center">Hình ảnh</th>
                            <th style="text-align: center">Thêm ảnh</th>
                            <th style="text-align: center">Hiển thị</th>
                            <th style="text-align: center">HĐ</th>
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
                                <td style="text-align: center">{{ $i }} </td>
                                <td style="max-width: 280px">{{ $pro->product_name }}</td>
                                <td>{{ number_format($pro->product_cost) }} VNĐ</td>
                                <td>{{ number_format($pro->product_price) }} VNĐ</td>
                                <td style="text-align: center">{{ $pro->product_quantity }}</td>
                                <td style="text-align: center">{{ $pro->category_name }}</td>
                                <td style="text-align: center">{{ $pro->brand_name }}</td>
                                <td style="text-align: center"><img src="public/uploads/product/{{ $pro->product_image }}"
                                        width="100"></td>
                                <td style="text-align: center">
                                    <a href="{{ URL::to('/add-gallery/' . $pro->product_id) }}">Thêm ảnh</a>
                                </td>
                                <td style="text-align: center"><span class="text-ellipsis">
                                        @if ($pro->product_status == 0)
                                            <a href="{{ URL::to('/active-product/' . $pro->product_id) }}">
                                                <span class="fa fa-toggle-off fa-thumb-styling"
                                                    title="Chọn để hiển thị"></span>
                                            </a>'
                                        @else
                                            <a href="{{ URL::to('/unactive-product/' . $pro->product_id) }}">
                                                <span class="fa fa-toggle-on fa-thumb-styling" title="Chọn để ẩn"></span>
                                            </a>
                                        @endif

                                    </span></td>
                                <td style="text-align: center">
                                    <a href="{{ URL::to('/edit-product/' . $pro->product_id) }}" class="btn btn-success"
                                        ui-toggle-class="" title="Sửa sản phẩm">
                                        Sửa
                                    </a>
                                    <a href="{{ URL::to('/delete-product/' . $pro->product_id) }}"
                                        class="btn btn-danger custom-delete-product" ui-toggle-class="" title="Xóa sản phẩm"
                                        onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')">
                                        Xóa
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
