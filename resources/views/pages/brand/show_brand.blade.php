@extends('layout')

@section('title')
    @foreach ($brand_name as $key => $name)
        <title>Thương hiệu: {{ $name->brand_name }} | MobileShop</title>
    @endforeach
@endsection

@section('category-product')
    <div class="col-sm-3">
        <div class="left-sidebar">
            <h2>Danh mục sản phẩm</h2>
            <div class="panel-group category-products" id="accordian">
                <!--category-productsr-->
                @foreach ($category as $key => $cate)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="{{ URL::to('/danh-muc-san-pham/' . $cate->category_id) }}"
                                    class="custom-primary-color-hover">
                                    <span class="badge pull-right"></span>
                                    {{ $cate->category_name }}
                                </a>
                            </h4>
                        </div>
                    </div>
                @endforeach

            </div>
            <!--/category-products-->

            <div class="brands_products">
                <!--brands_products-->
                <h2>Thương hiệu sản phẩm</h2>
                <div class="brands-name">
                    <ul class="nav nav-pills nav-stacked">
                        @foreach ($brand as $key => $brand)
                            <li><a href="{{ URL::to('/thuong-hieu-san-pham/' . $brand->brand_id) }}"
                                    class="custom-primary-color-hover"><span class="pull-right"></span>
                                    {{ $brand->brand_name }}
                                </a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!--/brands_products-->
        </div>
    </div>
@endsection

@section('content')
    <div class="col-md-3">
        <div>
            <label for="amount">Sắp xếp theo</label>
            <form>
                @csrf
                <select name="sort" id="sort" class="form-control">
                    <option value="{{ Request::url() }}?sort_by=none">--Lọc sản phẩm--</option>
                    <option value="{{ Request::url() }}?sort_by=tang_dan">Theo giá tăng dần</option>
                    <option value="{{ Request::url() }}?sort_by=giam_dan">Theo giá giảm dần</option>
                    <option value="{{ Request::url() }}?sort_by=ten_az">Theo tên từ A đến Z</option>
                    <option value="{{ Request::url() }}?sort_by=ten_za">Theo tên từ Z đến A</option>
                </select>
            </form>
        </div>
        <div style="margin-top: 40px">
            <label for="amount">Lọc giá sản phẩm</label>
            <form>
                <div id="slider-range"></div>
                <input type="hidden" name="start_price" id="start_price">
                <input type="hidden" name="end_price" id="end_price">

                @if ($max_price && $min_price)
                    <input type="hidden" name="max_price" id="max_price_product" value="{{ $max_price }}">
                    <input type="hidden" name="min_price" id="min_price_product" value="{{ $min_price }}">
                @endif

                <input type="text" id="amount" readonly style="border:0; color:#7016e5; font-weight:bold;">
                <input type="submit" value="Lọc giá" name="filter_price"
                    class="btn btn-success custom-btn-primary custom-btn-trans">
            </form>
        </div>
    </div>
    <div class="col-sm-9">
        <div class="features_items">
            <h2 class="title">
                Thương hiệu sản phẩm:

                @foreach ($brand_name as $key => $name)
                    <span style="text-transform:none; color: #333;"> {{ $name->brand_name }}</span>
                @endforeach

            </h2>

            <div class=" custom-product-home" style="grid-template-columns: 1fr 1fr 1fr 1fr">
                @foreach ($brand_by_id as $key => $product)
                    <div class="custom-product-bg">
                        <div class="product-image-wrapper" style="border-radius: 4px">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <form>
                                        @csrf
                                        <input type="hidden" value="{{ $product->product_id }}"
                                            class="cart_product_id_{{ $product->product_id }}">

                                        <input type="hidden" value="{{ $product->product_name }}"
                                            class="cart_product_name_{{ $product->product_id }}">

                                        <input type="hidden" value="{{ $product->product_image }}"
                                            class="cart_product_image_{{ $product->product_id }}">

                                        <input type="hidden" value="{{ $product->product_price }}"
                                            class="cart_product_price_{{ $product->product_id }}">

                                        <input type="hidden" value="{{ $product->product_quantity }}"
                                            class="cart_product_quantity_{{ $product->product_id }}">

                                        <input type="hidden" value="1"
                                            class="cart_product_qty_{{ $product->product_id }}">

                                        <input type="hidden" name="cart_product_id_{{ $product->product_id }}"
                                            id="">

                                        <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_id) }}"
                                            class="custom-product-img">
                                            <img src="{{ URL::to('public/uploads/product/' . $product->product_image) }}"
                                                alt="" height="180" width="auto" style="object-fit:cover" />
                                            <div style="min-height: 40px">
                                                <p class="custom-product-name">
                                                    {{ $product->product_name }}
                                                </p>
                                            </div>
                                            <h4 class="custom-primary-color">
                                                {{ number_format($product->product_price) }}đ</h4>
                                        </a>
                                        @if ($product->product_quantity > 0)
                                            <button type="button" class="btn btn-default add-to-cart"
                                                data-id="{{ $product->product_id }}">Thêm
                                                vào giỏ hàng</button>
                                        @else
                                            <p style="color: #dc3545; font-size: 16px">Sản phẩm hiện hết hàng</p>
                                        @endif
                                    </form>
                                </div>

                            </div>
                            {{-- <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                            <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                        </ul>
                    </div> --}}
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </div>
    </div>
    {{-- <div class="fb-comments" data-href="{{ $url_canonical }}" data-width="" data-numposts="5"></div> --}}
@endsection
