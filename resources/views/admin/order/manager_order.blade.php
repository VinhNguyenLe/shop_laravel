@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh sách đơn hàng
            </div>
            {{-- <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                    <select class="input-sm form-control w-sm inline v-middle">
                        <option value="0">Bulk action</option>
                        <option value="1">Delete selected</option>
                        <option value="2">Bulk edit</option>
                        <option value="3">Export</option>
                    </select>
                    <button class="btn btn-sm btn-default">Apply</button>
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" class="input-sm form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div> --}}
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
                            <th style="text-align: center">
                                STT
                            </th>
                            <th style="text-align: center">Mã đơn hàng</th>
                            <th style="text-align: center">Ngày đặt hàng</th>
                            <th style="text-align: center">Tên người đặt</th>
                            <th style="text-align: center">Tình trạng đơn hàng</th>
                            <th style="text-align: center">Hành động</th>
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
                                <td style="text-align: center">{{ $i }}</td>
                                <td style="text-align: center">{{ $ord->order_code }}</td>
                                <td style="text-align: center">{{ $ord->created_at }}</td>

                                <td style="text-align: center">
                                    @foreach ($customer as $key => $c)
                                        @if ($c->customer_id == $ord->customer_id)
                                            {{ $c->customer_name }}
                                        @endif
                                    @endforeach
                                </td>

                                <td style="text-align: center">
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

                                <td style="text-align: center">
                                    <a href="{{ URL::to('/view-order/' . $ord->order_code) }}" class="btn btn-success"
                                        ui-toggle-class="" title="Xem chi tiết đơn hàng">
                                        Xem chi tiết
                                    </a>
                                    {{-- <a href="{{ URL::to('/delete-order/' . $ord->order_code) }}" class="active styling-edit"
                                        ui-toggle-class="" title="Xóa đơn hàng"
                                        onclick="return confirm('Bạn chắc chắn muốn xóa đơn hàng này không?')">
                                        <i class="fa fa-times text-danger text"></i>
                                    </a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
