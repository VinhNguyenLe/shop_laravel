@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                thương hiệu sản phẩm
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
                            <th>Tên thương hiệu</th>
                            <th style="text-align: center">Hiển thị</th>
                            <th width="200px" style="text-align: center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($all_brand_product as $key => $brand_pro)
                            @php
                                $i++;
                            @endphp
                            <tr>
                                <td style="text-align: center">{{ $i }} </td>
                                <td>{{ $brand_pro->brand_name }}</td>
                                <td style="text-align: center"><span class="text-ellipsis">
                                        @if ($brand_pro->brand_status == 0)
                                            <a href="{{ URL::to('/active-brand-product/' . $brand_pro->brand_id) }}">
                                                <span class="fa fa-toggle-off fa-thumb-styling"
                                                    title="Chọn để hiển thị"></span>
                                            </a>'
                                        @else
                                            <a href="{{ URL::to('/unactive-brand-product/' . $brand_pro->brand_id) }}">
                                                <span class="fa fa-toggle-on fa-thumb-styling" title="Chọn để ẩn"></span>
                                            </a>
                                        @endif

                                    </span></td>
                                <td style="text-align: center">
                                    <a href="{{ URL::to('/edit-brand-product/' . $brand_pro->brand_id) }}"
                                        class=" btn btn-success" ui-toggle-class="" title="Sửa thương hiệu">
                                        Chỉnh sửa
                                    </a>
                                    <a href="{{ URL::to('/delete-brand-product/' . $brand_pro->brand_id) }}"
                                        class="btn btn-danger" ui-toggle-class="" title="Xóa thương hiệu"
                                        onclick="return confirm('Bạn chắc chắn muốn xóa chứ?')">
                                        Xóa
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <form action="{{ url('/export-brand-csv') }}" method="POST" style="padding: 20px">
                @csrf
                <input type="submit" value="Tải xuống file Excel" name="export_csv" class="btn btn-success">
            </form>
        </div>
    </div>
@endsection
