@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê danh mục sản phẩm
            </div>
            <div class="row w3-res-tb">

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
                            <th style="width:100px;">
                                STT
                            </th>
                            <th>Tên danh mục</th>
                            <th>Hiển thị</th>
                            <th style="width:200px;">Hành động</th>
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
                                <td>{{ $i }}
                                </td>
                                <td>{{ $cate_pro->category_name }}</td>
                                <td><span class="text-ellipsis">
                                        @if ($cate_pro->category_status == 0)
                                            <a href="{{ URL::to('/active-category-product/' . $cate_pro->category_id) }}">
                                                <span class="fa fa-eye-slash fa-thumb-styling"
                                                    title="Chọn để hiển thị"></span>
                                            </a>'
                                        @else
                                            <a href="{{ URL::to('/unactive-category-product/' . $cate_pro->category_id) }}">
                                                <span class="fa fa-eye fa-thumb-styling" title="Chọn để ẩn"></span>
                                            </a>
                                        @endif

                                    </span></td>
                                <td>
                                    <a href="{{ URL::to('/edit-category-product/' . $cate_pro->category_id) }}"
                                        class="active styling-edit" ui-toggle-class="" title="Sửa danh mục">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </a>
                                    <a href="{{ URL::to('/delete-category-product/' . $cate_pro->category_id) }}"
                                        class="active styling-edit" ui-toggle-class="" title="Xóa danh mục"
                                        onclick="return confirm('Bạn chắc chắn muốn xóa chứ?')">
                                        <i class="fa fa-times text-danger text"></i>
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
