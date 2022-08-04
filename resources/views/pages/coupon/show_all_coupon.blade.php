@extends('layout')

@section('title')
    <title>Mã khuyến mãi</title>
@endsection

@section('content')
    <h2 style="color: #42098d; text-align: center">Mã khuyến mãi của cửa hàng</h2>
    <div class="table-responsive">
        <table class="table table-striped  b-t b-light custom-table-center">
            <thead>
                <tr>
                    <th>Nội dung giảm giá</th>
                    <th style="text-align: center">Mã giảm giá</th>
                    <th>Số tiền giảm</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coupon as $key => $cou)
                    <tr>

                        <td>{{ $cou->coupon_name }}</td>
                        <td style="text-align: center">{{ $cou->coupon_code }}</td>

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

                            @if (strtotime($cou->coupon_date_end) >= strtotime($today))
                                <span class="text-success">Còn hạn</span>
                            @elseif(strtotime($cou->coupon_date_end) < strtotime($today))
                                <span class="text-danger"> Đã hết hạn</span>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
