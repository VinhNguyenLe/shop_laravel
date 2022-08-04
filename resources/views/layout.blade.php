<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <link href="{{ asset('public/frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/sweetalert.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/lightslider.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/prettify.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/lightgallery.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/lightgallery.min.css') }}" rel="stylesheet">

    <link href="{{ asset('public/frontend/css/custom.css') }}" rel="stylesheet">


    <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
    <link rel="shortcut icon" href="https://f7-zpcloud.zdn.vn/8694182849937176588/c6f480b37442b61cef53.jpg">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>
<!--/head-->

<body>

    <header id="header" style="overflow-x: hidden">
        <!--header-->
        <div class="header_top" style="background-color: #ede1fe; color:#7d2ae8; ">
            <!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4" style="padding-block: 8px;">
                        <div class="logo pull-left">
                            <a href="{{ URL::to('/') }}"
                                style="color: #7d2ae8; line-height: 40px; font-size: 32px; display: flex; align-items: center; font-weight: 700; font-style: italic">
                                <img src="https://f6-zpcloud.zdn.vn/1371599238416775478/6dc934c2f8333a6d6322.jpg"
                                    height="40" />
                                <span style="margin-left: 12px">MobileShop</span>
                            </a>
                        </div>

                    </div>
                    <div class="col-sm-4" style="padding-block: 10px">
                        <div class="search_box pull-right">
                            <form action="{{ URL::to('/tim-kiem') }}" method="GET" style="display: flex">
                                <input type="text" placeholder="Tìm kiếm sản phẩm..." name="keyword_submit"
                                    class="custom-search-input" />
                                {{-- <input type="submit" value="Tìm kiếm"
                                    class="btn btn-default custom-search-btn btn-sm custom-order-btn"
                                    name='search_item'> --}}
                                <button type="submit" value="Tìm kiếm" class="btn custom-search-btn custom-order-btn"
                                    name='search_item'><i class="fa fa-search" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="social-icons pull-right" style="display: flex; align-items:center; height: 56px">
                            <?php
                            $name = Session::get('customer_name');
                            if ($name) {
                                echo '<p class="custom-hello" style="height: 56px; line-height: 56px; padding-right: 12px">Xin chào, ' . $name . '</p>';
                                echo '<input type="hidden" value="' . $name . '"/>';
                            }
                            ?>
                            <div class="custom-bars-menu">
                                <i class="fa fa-bars"></i>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="row custom-category-wrap" style="border-bottom: 1px solid #7016e5">
                <div class="custom-category">
                    @foreach ($category as $key => $cate)
                        <div class="custom-category-item">
                            <a
                                href="{{ URL::to('/danh-muc-san-pham/' . $cate->category_id) }}">{{ $cate->category_name }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row custom-category-wrap" style="background-color: #7016e5">
                <div class="custom-category">
                    @foreach ($brand_data as $key => $brand)
                        <div class="custom-category-item">
                            <a href="{{ URL::to('/thuong-hieu-san-pham/' . $brand_data_id[$key]) }}">
                                {{ $brand_data[$key] }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!--/header_top-->
        <div class="custom-fixed-nav">
            <div class="custom-fixed-close">
                <i class="fa fa-times custom-fixed-close-click" aria-hidden="true"></i>
            </div>
            <ul class="custom-navbar-nav">
                <li><a href="{{ URL::to('/') }}">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        Trang chủ
                    </a></li>
                <li><a href="{{ URL::to('/lien-he') }}">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        Liên hệ
                    </a></li>
                <li><a href="{{ URL::to('/show-all-coupon') }}">
                        <i class="fa fa-gift" aria-hidden="true"></i>
                        Mã khuyễn mãi
                    </a></li>
                {{-- <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-user"></i> Tài khoản</a></li> --}}
                {{-- <li><a href="{{ URL::to('/') }}"><i class="fa fa-star"></i> Yêu thích</a></li> --}}
                <li><a href="{{ URL::to('/gio-hang') }}"><i class="fa fa-shopping-cart"></i> Giỏ
                        hàng</a></li>
                {{-- <li><a href="{{ URL::to('/show-cart') }}"><i class="fa fa-shopping-cart"></i> Giỏ
                    hàng</a></li> --}}
                <?php 
                $customer_id = Session::get('customer_id');
                $shipping_id = Session::get('shipping_id');
                if($customer_id != NULL && $shipping_id == NULL){
            ?>
                <li><a href="{{ URL::to('/checkout') }}"><i class="fa fa-money"></i> Thanh
                        toán</a></li>

                <?php 
                } elseif($customer_id != NULL && $shipping_id != NULL) { 
            ?>
                <li><a href="{{ URL::to('/payment') }}"><i class="fa fa-money"></i> Thanh
                        toán</a></li>
                <?php } else { ?>
                <li><a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-money"></i> Thanh
                        toán</a></li>
                <?php } ?>

                <?php 
                $customer_id = Session::get('customer_id');
                if($customer_id != NULL){
            ?>
                <li>
                    <a href="{{ URL::to('/history') }}"><i class="fa fa-bookmark"></i> Lịch sử đặt
                        hàng</a>
                </li>
                <li>
                    <a href="{{ URL::to('/logout-checkout') }}"><i class="fa fa-lock"></i> Đăng
                        xuất</a>
                </li>
                <?php } else { ?>

                <li>
                    <a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-sign-out"></i> Đăng
                        nhập</a>
                </li>
                <?php } ?>
            </ul>
        </div>

    </header>
    <!--/header-->

    <!--/slider-->
    <!--/slider-->
    @yield('slider')

    <section style="min-height: 100vh">
        <div class="container">
            <div class="row custom-section-wrap">
                {{-- @yield('category-product') --}}


                @yield('content')

            </div>
        </div>
    </section>

    <footer id="footer" style="">
        <div class="footer-mid container">
            <div class="row">
                <div class="footer-left col-md-6">
                    <h3>Mobile Shop</h3>
                    <div>
                        <a href="{{ URL::to('/') }}">
                            Trang chủ
                        </a>
                        <a href="{{ URL::to('/lien-he') }}">
                            Liên hệ
                        </a>
                        <a href="{{ URL::to('/show-all-coupon') }}"> Mã khuyễn mãi</a>
                    </div>
                </div>
                <div class="footer-right col-md-6">
                    <div class="footer-category">
                        <h4>Danh mục sản phẩm</h4>
                        @foreach ($category as $key => $cate)
                            <div class="footer-category-item">
                                <a
                                    href="{{ URL::to('/danh-muc-san-pham/' . $cate->category_id) }}">{{ $cate->category_name }}</a>
                            </div>
                        @endforeach
                    </div>
                    <div class="footer-category">
                        <h4>Thương hiệu sản phẩm</h4>
                        @foreach ($brand_data as $key => $brand)
                            <div class="footer-category-item">
                                <a href="{{ URL::to('/thuong-hieu-san-pham/' . $brand_data_id[$key]) }}">
                                    {{ $brand_data[$key] }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bot" style="text-align: center">
            <div class="row">Create by NLV © 2022</div>
        </div>
    </footer>
    <!--/Footer-->

    <script src="{{ asset('public/frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('public/frontend/js/main.js') }}"></script>
    <script src="{{ asset('public/frontend/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/lightslider.js') }}"></script>
    <script src="{{ asset('public/frontend/js/prettify.js') }}"></script>
    <script src="{{ asset('public/frontend/js/lightgallery-all.min.js') }}"></script>

    <script src="{{ asset('public/frontend/js/myCustom.js') }}"></script>

    {{-- <script>
        CKEDITOR: replace('ckeditor')
        CKEDITOR: replace('ckeditor1')
    </script> --}}
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0"
        nonce="x2Ca7K0h"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.add-to-cart').click(function() {
                // swal("Here's a message!", "It's pretty, isn't it?")
                let id = $(this).data('id')
                let cart_product_id = $('.cart_product_id_' + id).val();
                let cart_product_name = $('.cart_product_name_' + id).val();
                let cart_product_image = $('.cart_product_image_' + id).val();
                let cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                let cart_product_qty = $('.cart_product_qty_' + id).val();
                let _token = $('input[name="_token"]').val();

                if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
                    alert('Làm ơn đặt nhỏ hơn ' + cart_product_quantity);
                } else {

                    $.ajax({
                        url: '{{ url('/add-cart-ajax') }}',
                        method: 'POST',
                        data: {
                            cart_product_id: cart_product_id,
                            cart_product_name: cart_product_name,
                            cart_product_image: cart_product_image,
                            cart_product_price: cart_product_price,
                            cart_product_qty: cart_product_qty,
                            _token: _token,
                            cart_product_quantity: cart_product_quantity
                        },
                        success: function() {
                            swal({
                                    title: "Đã thêm sản phẩm vào giỏ hàng",
                                    text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    textClass: "custom-modal-swal-text",
                                    titleClass: "custom-primary-color",
                                    showCancelButton: true,
                                    cancelButtonText: "Xem tiếp",
                                    confirmButtonClass: "btn-success custom-btn-color-primary ",
                                    confirmButtonText: "Đi đến giỏ hàng",
                                    closeOnConfirm: false
                                },
                                function() {
                                    window.location.href = "{{ url('/gio-hang') }}";
                                });
                        }
                    });
                }
            })
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                // alert(action);
                //  alert(matp);
                //   alert(_token);

                if (action == 'city') {
                    result = 'province';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: '{{ url('/select-delivery-home') }}',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.calculate_delivery').click(function() {
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if (matp == '' && maqh == '' && xaid == '') {
                    alert('Bạn hãy chọn địa điểm để tính phí vận chuyển nhé!');
                } else {
                    $.ajax({
                        url: '{{ url('/calculate-fee') }}',
                        method: 'POST',
                        data: {
                            matp: matp,
                            maqh: maqh,
                            xaid: xaid,
                            _token: _token
                        },
                        success: function() {
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.send_order').click(function() {
                swal({
                        title: "Xác nhận đơn hàng",
                        text: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Cảm ơn, Mua hàng",

                        cancelButtonText: "Đóng,chưa mua",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            var shipping_email = $('.shipping_email').val();
                            var shipping_name = $('.shipping_name').val();
                            var shipping_address = $('.shipping_address').val();
                            var shipping_phone = $('.shipping_phone').val();
                            var shipping_notes = $('.shipping_notes').val();
                            var shipping_method = $('.payment_select').val();
                            var order_fee = $('.order_fee').val();
                            var order_coupon = $('.order_coupon').val();
                            var _token = $('input[name="_token"]').val();

                            $.ajax({
                                url: '{{ url('/confirm-order') }}',
                                method: 'POST',
                                data: {
                                    shipping_email: shipping_email,
                                    shipping_name: shipping_name,
                                    shipping_address: shipping_address,
                                    shipping_phone: shipping_phone,
                                    shipping_notes: shipping_notes,
                                    _token: _token,
                                    order_fee: order_fee,
                                    order_coupon: order_coupon,
                                    shipping_method: shipping_method
                                },
                                success: function() {
                                    swal("Đơn hàng",
                                        "Đơn hàng của bạn đã được gửi thành công",
                                        "success");
                                }
                            });

                            window.setTimeout(function() {
                                location.reload();
                            }, 3000);

                        } else {
                            swal("Đóng", "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng", "error");

                        }

                    });


            });
        });
    </script>
    <script>
        var msg = '{{ Session::get('alert') }}';
        var exist = '{{ Session::has('alert') }}';
        if (exist) {
            alert(msg);
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery: true,
                item: 1,
                loop: true,
                thumbItem: 3,
                slideMargin: 0,
                enableDrag: false,
                currentPagerPosition: 'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }
            });
        });
    </script>
    <script>
        $(".custom-bars-menu").click(function() {
            $(".custom-fixed-nav").toggleClass('active');
        });
        $(".custom-fixed-close-click").click(function() {
            $(".custom-fixed-nav").removeClass('active');
        });
        $('.custom-login-customer-form p').click(function() {
            $('.custom-login-customer-form').toggleClass('active')
            $('.custom-register-customer-form').toggleClass('active')
        })
        $('.custom-register-customer-form p').click(function() {
            $('.custom-login-customer-form').toggleClass('active')
            $('.custom-register-customer-form').toggleClass('active')
        })
    </script>
    <script></script>

</body>

</html>
