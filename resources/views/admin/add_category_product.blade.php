@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục sản phẩm
                </header>
                <div class="panel-body">

                    <div class="position-center">
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
                        <form role="form" method="post" action="{{ URL::to('/save-category-product') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="category-product-name">Tên danh mục</label>
                                <input type="text" class="form-control" id="category-product-name"
                                    placeholder="Nhập tên danh mục..." name="category_product_name">
                            </div>
                            <div class="form-group">
                                <label for="category-product-desc">Mô tả danh mục</label>
                                <textarea style="resize: none;" rows="5" class="form-control" id="category-product-desc"
                                    placeholder="Nhập mô tả danh mục..." name="category_product_desc"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="category-product-keywords">Keywords</label>
                                <textarea style="resize: none;" rows="4" class="form-control" id="category-product-keywords"
                                    placeholder="Nhập mô tả danh mục..." name="category_product_keywords"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Hiển thị?</label>
                                <select class="form-control input-sm m-bot15" name="category_product_status">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info" name="add_category_product">Thêm</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
