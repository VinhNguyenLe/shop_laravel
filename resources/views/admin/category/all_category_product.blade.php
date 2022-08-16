@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                danh mục sản phẩm
            </div>
            <div class="row w3-res-tb">
                <a href="{{ URL::to('/add-category-product') }}" class="btn btn-success custom-m14">Thêm danh mục</a>
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
                            <th style="width:20px;text-align: center">
                                STT
                            </th>
                            <th>Tên danh mục</th>
                            <th style="text-align: center">Hiển thị</th>
                            <th style="width:200px;text-align: center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($all_category_product as $key => $cate_pro)
                            @php
                                $i++;
                            @endphp
                            <tr>
                                <td style="text-align: center">{{ $i }}
                                </td>
                                <td>{{ $cate_pro->category_name }}</td>
                                <td style="text-align: center"><span class="text-ellipsis">
                                        @if ($cate_pro->category_status == 0)
                                            <a href="{{ URL::to('/active-category-product/' . $cate_pro->category_id) }}">
                                                <span class="fa fa-toggle-off fa-thumb-styling"
                                                    title="Chọn để hiển thị"></span>
                                            </a>'
                                        @else
                                            <a href="{{ URL::to('/unactive-category-product/' . $cate_pro->category_id) }}">
                                                <span class="fa fa-toggle-on fa-thumb-styling" title="Chọn để ẩn"></span>
                                            </a>
                                        @endif

                                    </span></td>
                                <td style="text-align: center">
                                    <a href="{{ URL::to('/edit-category-product/' . $cate_pro->category_id) }}"
                                        class="btn btn-success" ui-toggle-class="" title="Sửa danh mục">
                                        Chỉnh sửa
                                    </a>
                                    <a href="{{ URL::to('/delete-category-product/' . $cate_pro->category_id) }}"
                                        class="btn btn-danger" ui-toggle-class="" title="Xóa danh mục"
                                        onclick="return confirm('Bạn chắc chắn muốn xóa chứ?')">
                                        Xóa
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <form action="{{ url('/export-category-csv') }}" method="POST" style="padding: 20px">
                @csrf
                <input type="submit" value="Tải xuống file Excel" name="export_csv" class="btn btn-success">
            </form>

        </div>
    </div>
@endsection
