@extends('layout')
@section('title')
    <title>Chi tiết sản phẩm | MobileShop</title>
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
    <div></div>
    <?php
    $comment_noti = Session::get('comment_noti');
    if ($comment_noti) {
        echo '<p class="alert alert-success">' . $comment_noti . '</p>';
        Session::put('comment_noti', null);
    }
    ?>
    @foreach ($details_product as $key => $value)
        <div class="product-details">
            <!--product-details-->
            {{-- <div class="col-sm-5">
                <div class="view-product">
                    <img src="{{ URL::to('/public/uploads/product/' . $value->product_image) }}" alt=""
                        class="custom-view-product-img" />
                </div>
                <div id="similar-product" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner">
                        <div class="item active">
                            @foreach ($gallery as $key => $gal)
                                <img src="{{ URL::to('public/uploads/gallery/' . $gal->gallery_image) }}"
                                    alt="{{ $gal->gallery_name }}">
                            @endforeach

                        </div>
                    </div>

                    <a class="left item-control" href="#similar-product" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div> --}}
            <div class="col-sm-6">
                <!-- Wrapper for slides -->
                <ul id="imageGallery">
                    @foreach ($gallery as $key => $gal)
                        <li data-thumb="{{ URL::to('public/uploads/gallery/' . $gal->gallery_image) }}"
                            data-src="{{ URL::to('public/uploads/gallery/' . $gal->gallery_image) }}">
                            <img src="{{ URL::to('public/uploads/gallery/' . $gal->gallery_image) }}"
                                alt="{{ $gal->gallery_name }}" width="100%">
                        </li>
                    @endforeach

                </ul>
            </div>
            <div class="col-sm-6">
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
        <div class="row" style="margin-bottom: 40px">
            <div class="col-md-6">
                <div class="tab-pane fade active in" id="details">
                    <h3 class="custom-primary-color custom-font-24" style="margin-bottom: 12px">Giới thiệu sản phẩm</h3>

                    <div class="custom-font-20 custom-bg-white">{!! $value->product_desc !!}</div>
                </div>
            </div>
            <div class="col-md-6">
                {{-- Hiển thị chi tiết sản phẩm --}}
                <p class="custom-get-value">{!! $value->product_content !!}</p>
                <h3 class="custom-primary-color custom-font-24" style="margin-bottom: 12px">Thông số kĩ thuật</h3>
                <table class="custom-detail-table table table-striped" style="width: 100%">
                    <thead>
                        {{-- <th>key</th>
                            <th>value</th> --}}
                    </thead>
                    <tbody class="custom-tbody">

                    </tbody>
                </table>
            </div>
        </div>

        <div class="row" style="border-top: 1px solid #7d2ae8; padding: 0;">
            <h3 style="margin-block: 24px; color: #1c1f4a;">Bình luận</h3>

        </div>

        <form>
            @csrf
            <input type="hidden" name="product_id" class="comment_product_id" value="{{ $value->product_id }}">

            <div id="comment_show"></div>

        </form>
        @if (Session::get('customer_name'))
            <div class="row">
                <div class="col-md-7" style="background: #ede1fe; padding: 15px">
                    <h4 style="color: #1c1f4a; margin-bottom: 12px">Bình luận của bạn</h3>

                        <form>
                            @csrf

                            <span>
                                <input type="hidden" class="comment_name" placeholder="Tên của bạn"
                                    value="{{ Session::get('customer_name') }}">
                            </span>
                            <textarea name="comment" class="comment_content" placeholder="Nội dung bình luận" required rows="4"></textarea>
                            <button type="click" class="btn btn-success send-comment">Gửi bình luận</button>
                        </form>
                </div>
            </div>
        @else
            <p style="color: #656768; font-style: italic; font-size: 14px; margin-top: 24px">Bạn cần đăng nhập để bình
                luận
            </p>
        @endif





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
