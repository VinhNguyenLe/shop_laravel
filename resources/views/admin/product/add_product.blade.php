@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
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
                        <form role="form" method="post" action="{{ URL::to('/save-product') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="product-name">Tên sản phẩm</label>
                                <input data-validation="length" data-validation-length="min3"
                                    data-validation-error-msg="Tên sản phẩm phải ít nhất 3 kí tự" type="text"
                                    class="form-control" id="product-name" placeholder="Nhập tên sản phẩm..."
                                    name="product_name">
                            </div>
                            <div class="form-group">
                                <label for="product-price">Giá sản phẩm</label>
                                <input required type="number" class="form-control" id="product-price"
                                    placeholder="Nhập tên sản phẩm..." name="product_price">
                            </div>
                            <div class="form-group">
                                <label for="product-quantity">Số lượng sản phẩm</label>
                                <input required type="text" class="form-control" id="product-quantity"
                                    placeholder="Nhập SL sản phẩm..." name="product_quantity">
                            </div>
                            <div class="form-group">
                                <label>Danh mục sản phẩm</label>
                                <select class="form-control input-sm m-bot15" name="product_category">
                                    <option value="0">--Chọn danh mục--</option>
                                    @foreach ($category_product as $key => $cate)
                                        <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Thương hiệu sản phẩm</label>
                                <select class="form-control input-sm m-bot15" name="product_brand">
                                    <option value="0">--Chọn thương hiệu--</option>
                                    @foreach ($brand_product as $key => $brand)
                                        <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product-desc">Mô tả sản phẩm</label>
                                <textarea style="resize: none;" rows="4" class="form-control" id="product-desc"
                                    placeholder="Nhập mô tả sản phẩm..." name="product_desc"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="product-content">Nội dung sản phẩm</label>
                                <textarea style="resize: none;" rows="4" class="form-control" id="product-content"
                                    placeholder="Nhập nội dung sản phẩm..." name="product_content"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="product-image">Hình ảnh sản phẩm</label>
                                <input type="file" class="form-control" id="product-image" name="product_image">
                            </div>
                            <div class="form-group">
                                <label>Hiển thị?</label>
                                <select class="form-control input-sm m-bot15" name="product_status">
                                    <option value="0">Ẩn</option>
                                    <option value="1" selected="selected">Hiển thị</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info" name="add_product">Thêm sản phẩm</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
