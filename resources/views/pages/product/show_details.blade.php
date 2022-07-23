@extends('layout')
@section('title')
    <title>Chi tiết sản phẩm | E-Shopper</title>
@endsection

{{-- @section('category-product')
    <div class="col-sm-3">
        <div class="left-sidebar">
            <h2>Danh mục sản phẩm</h2>
            <div class="panel-group category-products" id="accordian">
                <!--category-productsr-->
                @foreach ($category as $key => $cate)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="{{ URL::to('/danh-muc-san-pham/' . $cate->category_id) }}">
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
                            <li><a href="{{ URL::to('/thuong-hieu-san-pham/' . $brand->brand_id) }}"><span
                                        class="pull-right">(0)</span>
                                    {{ $brand->brand_name }}
                                </a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!--/brands_products-->
        </div>
    </div>
@endsection --}}

@section('content')
    @foreach ($details_product as $key => $value)
        <div class="product-details">
            <!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">
                    <img src="{{ URL::to('/public/uploads/product/' . $value->product_image) }}" alt=""
                        class="custom-view-product-img" />
                    {{-- <h3>ZOOM</h3> --}}
                </div>
                <div id="similar-product" class="carousel slide" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <a href=""><img src="{{ URL::to('public/frontend/images/similar1.jpg') }}"
                                    alt=""></a>
                            <a href=""><img src="{{ URL::to('public/frontend/images/similar2.jpg') }}"
                                    alt=""></a>
                            <a href=""><img src="{{ URL::to('public/frontend/images/similar3.jpg') }}"
                                    alt=""></a>
                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
            <div class="col-sm-7">
                <div class="product-information custom-product-information">
                    <!--/product-information-->
                    <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                    <h2>{{ $value->product_name }}</h2>
                    <p>Mã sản phẩm: {{ $value->product_id }}</p>
                    {{-- <img src="images/product-details/rating.png" alt="" /> --}}
                    {{-- <form action="{{ URL::to('/save-cart') }}" method="POST"> --}}
                    <form>
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $value->product_id }}"
                            class="cart_product_id_{{ $value->product_id }}">

                        <input type="hidden" value="{{ $value->product_name }}"
                            class="cart_product_name_{{ $value->product_id }}">

                        <input type="hidden" value="{{ $value->product_image }}"
                            class="cart_product_image_{{ $value->product_id }}">

                        <input type="hidden" value="{{ $value->product_price }}"
                            class="cart_product_price_{{ $value->product_id }}">

                        <input type="hidden" value="{{ $value->product_quantity }}"
                            class="cart_product_quantity_{{ $value->product_id }}">

                        {{-- <input type="hidden" value="1" class="cart_product_qty_{{ $value->product_id }}"> --}}

                        <span>
                            <h3 style="margin-bottom: 0">Giá:</h3>

                            <span>{{ number_format($value->product_price) }} VNĐ</span>
                            <label>Số lượng:</label>
                            <input name="qty" type="number" min="1"
                                class="cart_product_qty_{{ $value->product_id }}" value="1" />
                            <input name="productid_hidden" type="hidden" value="{{ $value->product_id }}" />

                        </span>
                    </form>
                    <p><b>Kho: </b> {{ $value->product_quantity }}</p>
                    <p><b>Thương hiệu:</b> <a href="{{ URL::to('/thuong-hieu-san-pham/' . $value->brand_id) }}"
                            class="custom-primary-color">{{ $value->brand_name }}</a></p>
                    <p><b>Danh muc:</b> <a href="{{ URL::to('/danh-muc-san-pham/' . $value->category_id) }}"
                            class="custom-primary-color">{{ $value->category_name }}</a></p>
                    {{-- <a href=""><img src="images/product-details/share.png" class="share img-responsive"
                            alt="" /></a> --}}
                    @if ($value->product_quantity > 0)
                        <button type="button" class="btn btn-default custom-btn-primary add-to-cart"
                            data-id="{{ $value->product_id }}" style="margin: 30px 0">Thêm
                            vào giỏ hàng</button>
                    @else
                        <p style="color: #dc3545; font-size: 16px">Sản phẩm hiện hết hàng</p>
                    @endif

                </div>
                <!--/product-information-->
            </div>
        </div>
        <!--/product-details-->

        <div class="category-tab shop-details-tab">
            <!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
                    <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
                    {{-- <li><a href="#reviews" data-toggle="tab">Đánh giá</a></li> --}}
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="details">
                    <div class="custom-font-20 custom-bg-white">{!! $value->product_desc !!}</div>
                </div>
                <div class="tab-pane fade" id="companyprofile">
                    {{-- Hiển thị chi tiết sản phẩm --}}
                    <p class="custom-get-value">{!! $value->product_content !!}</p>
                    <p class="custom-primary-color custom-font-20">Thông số kĩ thuật</p>
                    <table class="custom-detail-table table table-striped">
                        <thead>
                            {{-- <th>key</th>
                            <th>value</th> --}}
                        </thead>
                        <tbody class="custom-tbody">

                        </tbody>
                    </table>
                </div>


                {{-- <div class="tab-pane fade " id="reviews">
                    <div class="col-sm-12">
                        <ul>
                            <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                            <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                            <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                            nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate
                            velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        <p><b>Write Your Review</b></p>

                        <form action="#">
                            <span>
                                <input type="text" placeholder="Your Name" />
                                <input type="email" placeholder="Email Address" />
                            </span>
                            <textarea name=""></textarea>
                            <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                            <button type="button" class="btn btn-default pull-right">
                                Submit
                            </button>
                        </form>
                    </div>
                </div> --}}

            </div>
        </div>
        <!--/category-tab-->
    @endforeach


    <div class="recommended_items">
        <!--recommended_items-->
        <h2 class="title text-center">Sản phẩm liên quan</h2>

        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    @foreach ($related_product as $key => $value)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{ URL::to('public/uploads/product/' . $value->product_image) }}"
                                            alt="" />
                                        <h2>{{ number_format($value->product_price) }} VNĐ</h2>
                                        <p>{{ $value->product_name }}</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>

            </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
    <!--/recommended_items-->
@endsection
