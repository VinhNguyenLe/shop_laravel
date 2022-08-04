@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục sản phẩm
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
                    @foreach ($edit_category_product as $key => $edit_value)
                        <div class="position-center">

                            <form role="form" method="post"
                                action="{{ URL::to('/update-category-product/' . $edit_value->category_id) }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="category-product-name">Tên danh mục</label>
                                    <input type="text" class="form-control" id="category-product-name"
                                        placeholder="Nhập tên danh mục..." name="category_product_name"
                                        value="{{ $edit_value->category_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="category-product-desc">Mô tả danh mục</label>
                                    <textarea style="resize: none;" rows="5" class="form-control" id="category-product-desc"
                                        placeholder="Nhập mô tả danh mục..." name="category_product_desc">{{ $edit_value->category_desc }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="category-product-keywords">Keywords</label>
                                    <textarea style="resize: none;" rows="4" class="form-control" id="category-product-keywords"
                                        placeholder="Nhập mô tả danh mục..." name="category_product_keywords">{{ $edit_value->meta_keywords }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-info" name="update_category_product">Cập nhật danh
                                    mục</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>

        </div>
    </div>
@endsection
