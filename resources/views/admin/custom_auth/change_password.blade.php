@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Đổi mật khẩu
                </header>
                <div class="panel-body">
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
                    <div class="position-center">

                        <form role="form" method="post" action="{{ URL::to('/update-password-change') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <p>Bạn đang đổi mật khẩu cho tài khoản: <span>{{ $admin_id }}</span></p>
                            </div>

                            <div class="form-group">
                                <label for="new-password">Mật khẩu mới</label>
                                <input type="text" class="form-control" id="new-password" name="new_password"
                                    value="">
                            </div>

                            {{-- <button type="submit" class="btn btn-info" name="update_change_password">Đổi mật
                                khẩu</button> --}}
                            <div class="btn btn-primary">Đổi mật khẩu</div>
                        </form>
                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection
