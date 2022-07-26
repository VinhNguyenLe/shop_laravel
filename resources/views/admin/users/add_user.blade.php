@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm tài khoản
                </header>
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<div class="alert alert-success">' . $message . '</div>';
                    Session::put('message', null);
                }
                ?>
                <div class="panel-body">

                    <div class="position-center">
                        <form role="form" action="{{ URL::to('store-users') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên</label>
                                <input type="text" name="admin_name" class="form-control" id="exampleInputEmail1"
                                    placeholder="Tên danh mục">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số điện thoại</label>
                                <input type="text" name="admin_phone" class="form-control" id="exampleInputEmail1"
                                    placeholder="Slug">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" name="admin_email" class="form-control" id="exampleInputEmail1"
                                    placeholder="Slug">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="text" name="admin_password" class="form-control" id="exampleInputEmail1"
                                    placeholder="Slug">
                            </div>

                            <button type="submit" name="add_category_product" class="btn btn-info">Thêm users</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    @endsection
