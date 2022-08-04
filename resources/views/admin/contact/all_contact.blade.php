@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin liên hệ
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
                            <th style="width:20px;text-align: center">
                                STT
                            </th>
                            <th>Tiêu đề</th>
                            <th>Nội dung</th>
                            <th style="text-align: center">Hiển thị</th>
                            <th style="width:200px;text-align: center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($contact as $key => $ct)
                            @php
                                $i++;
                            @endphp
                            <tr>
                                <td style="text-align: center">{{ $i }}
                                </td>
                                <td>{{ $ct->contact_title }}</td>
                                <td>{{ $ct->contact_content }}</td>
                                <td style="text-align: center"><span class="text-ellipsis">
                                        {{-- <div class="custom-toggle-btn"></div> --}}
                                        @if ($ct->contact_status == 0)
                                            <a href="{{ URL::to('/enable-contact/' . $ct->contact_id) }}">
                                                <span class="fa fa-toggle-off fa-thumb-styling"
                                                    title="Chọn để hiển thị"></span>
                                            </a>'
                                        @else
                                            <a href="{{ URL::to('/disable-contact/' . $ct->contact_id) }}">
                                                <span class="fa fa-toggle-on fa-thumb-styling" title="Chọn để ẩn"></span>
                                            </a>
                                        @endif

                                    </span></td>
                                <td style="text-align: center">
                                    <a href="{{ URL::to('/edit-contact/' . $ct->contact_id) }}" class="btn btn-success"
                                        ui-toggle-class="" title="Chỉnh sửa">
                                        Chỉnh sửa
                                    </a>
                                    <a href="{{ URL::to('/delete-contact/' . $ct->contact_id) }}" class="btn btn-danger"
                                        ui-toggle-class="" title="Xóa"
                                        onclick="return confirm('Bạn muốn xóa nội dung này không?')">
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
