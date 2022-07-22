@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê đơn hàng
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
                            <th>
                                STT
                            </th>
                            <th>Mã đơn hàng</th>
                            <th>Ngày đặt hàng</th>
                            <th>Tên người đặt</th>
                            <th>Tình trạng đơn hàng</th>
                            <th>Hành động</th>
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
                                    @foreach ($customer as $key => $c)
                                        @if ($c->customer_id == $ord->customer_id)
                                            {{ $c->customer_name }}
                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    @if ($ord->order_status == 1)
                                        Đơn hàng mới
                                    @else
                                        Đã xử lý
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ URL::to('view-order/' . $ord->order_code) }}" class="active styling-edit"
                                        ui-toggle-class="" title="Xem chi tiết đơn hàng">
                                        <i class="fa fa-eye text-success text-active"></i>
                                    </a>
                                    <a href="{{ URL::to('/delete-order/' . $ord->order_code) }}"
                                        class="active styling-edit" ui-toggle-class="" title="Xóa đơn hàng"
                                        onclick="return confirm('Bạn chắc chắn muốn xóa đơn hàng này không?')">
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
