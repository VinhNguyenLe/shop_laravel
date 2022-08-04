@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Slider
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
                            <th style="width:40px;" style="text-align: center">
                                STT
                            </th>
                            <th>Tên slide</th>
                            <th style="text-align: center">Hình ảnh</th>
                            <th style="text-align: center">Mô tả</th>
                            <th style="text-align: center">Trạng thái hiển thị</th>

                            <th style="text-align: center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($all_slide as $key => $slide)
                            @php
                                $i++;
                            @endphp
                            <tr>
                                <td style="text-align: center">
                                    {{ $i }}
                                </td>
                                <td>{{ $slide->slider_name }}</td>
                                <td><img src="public/uploads/slider/{{ $slide->slider_image }}" height="120"
                                        width="300" style="object-fit: contain">
                                </td>
                                <td style="text-align: center">{{ $slide->slider_desc }}</td>
                                <td style="text-align: center"><span class="text-ellipsis">
                                        <?php
                                            if($slide->slider_status==1){
                                        ?>
                                        <a href="{{ URL::to('/unactive-slide/' . $slide->slider_id) }}">
                                            <span class="fa fa-toggle-on fa-thumb-styling" title="Chọn để ẩn"></span>
                                        </a>
                                        <?php
                                        }else{
                                        ?>
                                        <a href="{{ URL::to('/active-slide/' . $slide->slider_id) }}">
                                            <span class="fa fa-toggle-off fa-thumb-styling" title="Chọn để hiển thị"></span>
                                        </a>
                                        <?php
                                        }
                                        ?>
                                    </span></td>
                                <td style="text-align: center">

                                    <a onclick="return confirm('Bạn có chắc là muốn xóa slide này ko?')"
                                        href="{{ URL::to('/delete-slide/' . $slide->slider_id) }}" class="btn btn-danger"
                                        ui-toggle-class="">
                                        Xóa
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
