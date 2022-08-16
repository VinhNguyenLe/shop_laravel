@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                mã khuyến mãi
            </div>



            <div class="table-responsive" style="margin-top: 30px">
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
                <div style="margin: 0 0 0 12px">
                    <a href="{{ URL::to('add-coupon') }}" class="btn btn-success">Thêm mã khuyến mãi</a>
                </div>
                <table class="table table-striped b-t b-light custom-table-center">
                    <thead>
                        <tr>
                            @php
                                $i = 0;
                            @endphp
                            <th>STT</th>
                            <th>Nội dung giảm giá</th>
                            <th style="text-align: center">Mã giảm giá</th>
                            <th>Hình thức giảm giá</th>
                            <th>Số tiền giảm </th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Trạng thái</th>
                            <th>Hôm nay</th>

                            <th style="width:160px; text-align: center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupon as $key => $cou)
                            @php
                                $i++;
                            @endphp
                            <tr>
                                <td>{{ $i }}
                                </td>
                                <td>{{ $cou->coupon_name }}</td>
                                <td style="text-align: center">{{ $cou->coupon_code }}</td>
                                <td>
                                    <span class="text-ellipsis">
                                        @if ($cou->coupon_condition == 1)
                                            Giảm theo phần trăm
                                        @else
                                            Giảm theo tiền
                                        @endif

                                    </span>
                                </td>
                                <td>
                                    <span class="text-ellipsis">
                                        @if ($cou->coupon_condition == 1)
                                            {{ $cou->coupon_number }} %
                                        @else
                                            {{ number_format($cou->coupon_number, 0, ',', '.') }} VNĐ
                                        @endif

                                    </span>
                                </td>

                                <td>
                                    {{ $cou->coupon_date_start }}

                                </td>
                                <td>
                                    {{ $cou->coupon_date_end }}
                                </td>
                                <td>
                                    @if ($cou->coupon_status == 1)
                                        <span class="text-success">Đang kích hoạt</span>
                                    @elseif($cou->coupon_status == 0)
                                        <span class="text-danger">Chưa kích hoạt</span>
                                    @endif
                                </td>
                                <td>

                                    @if (strtotime($cou->coupon_date_end) >= strtotime($today))
                                        <span class="text-success">Còn hạn</span>
                                    @elseif(strtotime($cou->coupon_date_end) < strtotime($today))
                                        <span class="text-danger"> Đã hết hạn</span>
                                    @endif
                                </td>
                                <td style="text-align: center">

                                    <a href="{{ URL::to('/delete-coupon/' . $cou->coupon_id) }}" class="btn btn-danger"
                                        ui-toggle-class="" title="Xóa thương hiệu"
                                        onclick="return confirm('Bạn chắc muốn xóa mã khuyến mãi này không?')">
                                        Xóa
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    {{-- <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                            <li><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href="">4</a></li>
                            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                        </ul>
                    </div> --}}
                </div>
            </footer>
        </div>
    </div>
@endsection
