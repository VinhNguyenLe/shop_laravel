@extends('layout')

@section('title')
    @foreach ($category_name as $key => $name)
        <title>Danh mục: {{ $name->category_name }} | MobileShop</title>
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
                                <a class="custom-primary-color-hover"
                                    href="{{ URL::to('/danh-muc-san-pham/' . $cate->category_id) }}">
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
                            <li><a class="custom-primary-color-hover"
                                    href="{{ URL::to('/thuong-hieu-san-pham/' . $brand->brand_id) }}"><span
                                        class="pull-right"></span>
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
    <div class="col-sm-9 padding-right">

        {{-- <div class="custom-flex-align-center">
        <div class="fb-share-button" data-href="http://localhost/shop" data-layout="button_count" data-size="small">
            <a target="_blank"
                href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}&amp;src=sdkpreparse"
                class="fb-xfbml-parse-ignore">Chia sẻ</a>
        </div>
        <div class="fb-like" data-href="http://localhost/shop/danh-muc-san-pham/1" data-width=""
            data-layout="button_count" data-action="like" data-size="small" data-share="false"></div>
       </div> --}}
        {{-- <div class="fb-like" data-href="http://localhost/shop/danh-muc-san-pham/1" data-width="" data-layout="button_count"
            data-action="like" data-size="small" data-share="true"></div>
        <div class="features_items"> --}}

        <h2 class="title">
            Danh mục sản phẩm:

            @foreach ($category_name as $key => $name)
                <span style="text-transform:none; color: #333;"> {{ $name->category_name }}</span>
            @endforeach

        </h2>

        @foreach ($category_by_id as $key => $product)
            <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_id) }}">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ URL::to('public/uploads/product/' . $product->product_image) }}" alt=""
                                    height="180" width="auto" style="object-fit:cover" />
                                <h2>{{ number_format($product->product_price) }} VNĐ</h2>
                                <p>{{ $product->product_name }}</p>
                                <a href="#" class="btn btn-default add-to-cart"><i
                                        class="fa fa-shopping-cart"></i>Thêm
                                    vào
                                    giỏ
                                    hàng</a>
                            </div>

                        </div>

                    </div>
                </div>
            </a>
        @endforeach
    </div>
    </div>
    <div class="fb-comments" data-href="{{ $url_canonical }}" data-width="" data-numposts="5"></div>
@endsection
