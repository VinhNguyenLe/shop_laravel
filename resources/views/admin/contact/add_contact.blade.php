@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm liên hệ
                </header>
                <div class="panel-body">

                    <div class="position-center">
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
                        <form role="form" method="post" action="{{ URL::to('/save-contact') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="contact-title">Tiêu đề</label>
                                <input type="text" class="form-control" id="contact-title" name="contact_title">
                            </div>
                            <div class="form-group">
                                <label for="contact-content">Nội dung</label>
                                <textarea style="resize: none;" rows="5" class="form-control" id="contact-content" name="contact_content"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Hiển thị?</label>
                                <select class="form-control input-sm m-bot15" name="contact_status">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info" name="add_contact">Thêm</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
