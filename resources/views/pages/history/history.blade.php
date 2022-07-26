@extends('layout')

@section('title')
    <title>Lịch sử đặt hàng</title>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading" style="font-size: 20px">
            Đơn hàng đã đặt
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
            <table class="table table-striped b-t b-light custom-history-table">
                <thead>
                    <tr>
                        <th>
                            STT
                        </th>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Tình trạng đơn hàng</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($order as $key => $ord)
                        @php
                            $i++;
                        @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $ord->order_code }}</td>
                            <td>{{ $ord->created_at }}</td>


                            <td>
                                @if ($ord->order_status == 1)
                                    Đơn hàng chưa xử lý
                                @elseif($ord->order_status == 2)
                                    <span style="color: #28a745">
                                        Đơn hàng đã xử lý
                                    </span>
                                @elseif($ord->order_status == 3)
                                    <span style="color: #dc3545">
                                        Đơn hàng bị hủy
                                    </span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ URL::to('/view-history/' . $ord->order_code) }}" class="btn btn-success"
                                    title="Xem chi tiết đơn hàng">
                                    Chi tiết
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
