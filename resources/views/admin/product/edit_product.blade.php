@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật sản phẩm
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
                        @foreach ($edit_product as $key => $pro)
                            <form role="form" method="post" action="{{ URL::to('/update-product/' . $pro->product_id) }}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="product-name">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="product-name"
                                        value="{{ $pro->product_name }}" name="product_name">
                                </div>
                                <div class="form-group">
                                    <label for="product-cost">Giá gốc</label>
                                    <input type="text" class="form-control" id="product-cost"
                                        value="{{ $pro->product_cost }}" name="product_cost">
                                </div>
                                <div class="form-group">
                                    <label for="product-price">Giá bán</label>
                                    <input type="text" class="form-control" id="product-price"
                                        value="{{ $pro->product_price }}" name="product_price">
                                </div>
                                <div class="form-group">
                                    <label for="product-quantity">SL sản phẩm</label>
                                    <input type="text" class="form-control" id="product-quantity"
                                        value="{{ $pro->product_quantity }}" name="product_quantity">
                                </div>
                                <div class="form-group">
                                    <label>Danh mục sản phẩm</label>
                                    <select class="form-control input-sm m-bot15" name="product_category">
                                        @foreach ($category_product as $key => $cate)
                                            @if ($cate->category_id == $pro->category_id)
                                                <option selected value="{{ $cate->category_id }}">{{ $cate->category_name }}
                                                </option>
                                            @else
                                                <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Thương hiệu sản phẩm</label>
                                    <select class="form-control input-sm m-bot15" name="product_brand">
                                        @foreach ($brand_product as $key => $brand)
                                            @if ($brand->brand_id == $pro->brand_id)
                                                <option selected value="{{ $brand->brand_id }}">{{ $brand->brand_name }}
                                                </option>
                                            @else
                                                <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="product-desc">Mô tả sản phẩm</label>
                                    <textarea style="resize: none;" rows="4" class="form-control" id="product-desc" name="product_desc">{{ $pro->product_desc }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="product-content">Nội dung sản phẩm</label>
                                    <textarea style="resize: none;" rows="4" class="form-control" id="product-content" name="product_content">{{ $pro->product_content }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="product-image">Hình ảnh sản phẩm</label>
                                    <input type="file" class="form-control" id="product-image" name="product_image">
                                    <img src="{{ URL::to('public/uploads/product/' . $pro->product_image) }}"
                                        height="100" width="auto">
                                </div>
                                <div class="form-group">
                                    <label>Hiển thị?</label>
                                    <select class="form-control input-sm m-bot15" name="product_status">
                                        <option value="{{ $pro->product_status }}">Ẩn</option>

                                        <option value="1" selected>Hiển thị</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-info" name="add_product">Cập nhật sản phẩm</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
