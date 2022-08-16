@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tài khoản Nhân viên
            </div>
            <div class="row w3-res-tb">
                <a href="{{ URL::to('/add-user') }}" class="btn btn-success custom-m14">Thêm tài khoản</a>
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
                <table class="table table-striped b-t b-light custom-table-center">

                    <thead style="text-align: center">
                        <tr>
                            <th style="width:20px; text-align: center">
                                STT
                            </th>
                            <th style="text-align: center">Tên</th>
                            <th style="text-align: center">Email</th>
                            <th style="text-align: center">SĐT</th>
                            {{-- <th style="text-align: center">Mật khẩu</th> --}}
                            <th style="text-align: center">Admin</th>
                            <th style="text-align: center">Manager</th>
                            <th style="text-align: center">User</th>
                            <th style="text-align: center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($admin as $key => $user)
                            @php
                                $i++;
                            @endphp
                            <form action="{{ URL::to('/assign-roles') }}" method="POST">
                                @csrf
                                <tr>
                                    <td style="text-align: center">{{ $i }} </td>
                                    <td>{{ $user->admin_name }}</td>

                                    <td>
                                        {{ $user->admin_email }}
                                        <input type="hidden" name="admin_email" value="{{ $user->admin_email }}">
                                        <input type="hidden" name="admin_id" value="{{ $user->admin_id }}">
                                    </td>
                                    <td>{{ $user->admin_phone }}</td>
                                    {{-- <td>{{ $user->admin_password }}</td> --}}
                                    <td style="text-align: center">
                                        <input type="checkbox" name="admin_role"
                                            {{ $user->hasRole('admin') ? 'checked' : '' }}>
                                    </td>
                                    <td style="text-align: center">
                                        <input type="checkbox" name="manager_role"
                                            {{ $user->hasRole('manager') ? 'checked' : '' }}>
                                    </td>
                                    <td style="text-align: center">
                                        <input type="checkbox" name="user_role"
                                            {{ $user->hasRole('user') ? 'checked' : '' }}>
                                    </td>
                                    <td style="text-align: center">
                                        <input type="submit" value="Phân quyền" class="btn btn-sm btn-success">
                                        <a href="{{ URL::to('/delete-user-roles/' . $user->admin_id) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Bạn có chắc muốn xóa tài khoản của {{ $user->admin_name }} không?')">Xóa</a>


                                    </td>
                                </tr>

                            </form>
                        @endforeach
                    </tbody>
                </table>

            </div>
            {{-- <form action="{{ url('/export-brand-csv') }}" method="POST" style="padding: 20px">
                @csrf
                <input type="submit" value="Tải xuống file Excel" name="export_csv" class="btn btn-success">
            </form> --}}
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            {!! $admin->links() !!}
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
