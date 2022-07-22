@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê Slider
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
                            <th style="width:20px;">

                            </th>
                            <th>Tên slide</th>
                            <th>Hình ảnh</th>
                            <th>Mô tả</th>
                            <th>Trạng thái hiển thị</th>

                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_slide as $key => $slide)
                            <tr>
                                <td>
                                </td>
                                <td>{{ $slide->slider_name }}</td>
                                <td><img src="public/uploads/slider/{{ $slide->slider_image }}" height="120" width="500"
                                        style="object-fit: contain">
                                </td>
                                <td>{{ $slide->slider_desc }}</td>
                                <td><span class="text-ellipsis">
                                        <?php
               if($slide->slider_status==1){
                ?>
                                        <a href="{{ URL::to('/unactive-slide/' . $slide->slider_id) }}">
                                            <span class="fa fa-eye fa-thumb-styling" title="Chọn để ẩn"></span>
                                        </a>
                                        <?php
                 }else{
                ?>
                                        <a href="{{ URL::to('/active-slide/' . $slide->slider_id) }}">
                                            <span class="fa fa-eye-slash fa-thumb-styling" title="Chọn để hiển thị"></span>
                                        </a>
                                        <?php
               }
              ?>
                                    </span></td>
                                <td>

                                    <a onclick="return confirm('Bạn có chắc là muốn xóa slide này ko?')"
                                        href="{{ URL::to('/delete-slide/' . $slide->slider_id) }}"
                                        class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-times text-danger text"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
