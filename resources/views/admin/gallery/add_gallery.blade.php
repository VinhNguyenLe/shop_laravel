@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm hình ảnh phụ
                </header>
                <div class="panel-body">

                    <form action="{{ URL::to('/insert-gallery/' . $product_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3" style="line-height: 34px">Tên sản phẩm:
                                {{ $product_name }}</div>
                            <div class="col-md-6">
                                <input type="file" name="file[]" accept="image/*" class="form-control" multiple
                                    id="gallery_files">
                            </div>
                            <div class="col-md-3">
                                <input type="submit" value="Upload" name="upload" class="btn btn-success">
                            </div>
                        </div>
                    </form>
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
                    <div id="error_gallery"></div>


                    <input type="hidden" value="{{ $product_id }}" name="product_id" class="product_id">
                    <form>
                        @csrf
                        <div id="gallery-load">

                        </div>
                    </form>
                </div>
            </section>

        </div>
    </div>
@endsection
