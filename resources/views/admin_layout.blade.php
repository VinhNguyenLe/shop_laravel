<!DOCTYPE html>

<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords"
        content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
 Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/bootstrap.min.css') }}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{ asset('public/backend/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('public/backend/css/style-responsive.css') }}" rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/font.css') }}" type="text/css" />
    <link href="{{ asset('public/backend/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/backend/css/morris.css') }}" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/monthly.css') }}">
    <link rel="shortcut icon" href="https://f7-zpcloud.zdn.vn/8694182849937176588/c6f480b37442b61cef53.jpg"
        type="image/x-icon">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{ asset('public/backend/js/jquery2.0.3.min.js') }}"></script>
    <script src="{{ asset('public/backend/js/raphael-min.js') }}"></script>
    <script src="{{ asset('public/backend/js/morris.js') }}"></script>

    <link href="{{ asset('public/backend/css/custom.css') }}" rel='stylesheet' type='text/css' />

</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="{{ URL::to('/dashboard') }}" class="logo" style="text-transform: unset">
                    Dashboard
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->
            <!--  -->
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">

                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{ asset('public/backend/images/admin-logo.jpg') }}">
                            <span class="username">
                                <?php
                                // $name = Session::get('admin_name');
                                $name = Auth::user()->admin_name;
                                if ($name) {
                                    echo $name;
                                }
                                ?>
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="{{ URL::to('/change-password') }}"><i class="fa fa-unlock-alt"></i> Đổi mật
                                    khẩu</a>
                            </li>
                            {{-- <li><a href="{{ URL::to('/logout') }}"><i class="fa fa-key"></i> Đăng xuất</a></li> --}}
                            <li><a href="{{ URL::to('/logout-auth') }}"><i class="fa fa-key"></i> Đăng xuất</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a href="{{ URL::to('/dashboard') }}">
                                <i class="fa fa-dashboard"></i>
                                <span>Tổng quan</span>
                            </a>
                        </li>
                        @hasrole('admin')
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-book"></i>
                                    <span>Phân quyền nhân viên</span>
                                </a>
                                <ul class="sub">
                                    <li><a href="{{ URL::to('/add-user') }}">Thêm tài khoản</a></li>
                                    <li><a href="{{ URL::to('/user') }}">Danh sách tài khoản</a>
                                    </li>
                                </ul>
                            </li>
                        @endhasrole
                        @hasrole(['admin', 'manager'])
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-book"></i>
                                    <span>Danh mục sản phẩm</span>
                                </a>
                                <ul class="sub">
                                    <li><a href="{{ URL::to('/add-category-product') }}">Thêm danh mục sản phẩm</a></li>
                                    <li><a href="{{ URL::to('/all-category-product') }}">Danh sách danh mục sản phẩm</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-book"></i>
                                    <span>Thương hiệu sản phẩm</span>
                                </a>
                                <ul class="sub">
                                    <li><a href="{{ URL::to('/add-brand-product') }}">Thêm thương hiệu sản phẩm</a></li>
                                    <li><a href="{{ URL::to('/all-brand-product') }}">Danh sách thương hiệu sản phẩm</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-book"></i>
                                    <span>Sản phẩm</span>
                                </a>
                                <ul class="sub">
                                    <li><a href="{{ URL::to('/add-product') }}">Thêm sản phẩm</a></li>
                                    <li><a href="{{ URL::to('/all-product') }}">Danh sách sản phẩm</a></li>
                                </ul>
                            </li>

                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-book"></i>
                                    <span>Mã giảm giá</span>
                                </a>
                                <ul class="sub">
                                    <li><a href="{{ URL::to('/add-coupon') }}">Thêm mã giảm giá</a></li>
                                    <li><a href="{{ URL::to('/list-coupon') }}">Danh sách mã giảm giá</a></li>
                                </ul>
                            </li>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-book"></i>
                                    <span>Địa chỉ vận chuyển</span>
                                </a>
                                <ul class="sub">
                                    <li><a href="{{ URL::to('/delivery') }}">Quản lý địa chỉ vận chuyển</a></li>
                                </ul>
                            </li>
                            <li class="sub-menu">
                                <a href="{{ URL::to('/manager-order') }}">
                                    <i class="fa fa-book"></i>
                                    <span>Đơn đặt hàng</span>
                                </a>
                            </li>
                            <li class="sub-menu">
                                <a href="{{ URL::to('/list-comment') }}">
                                    <i class="fa fa-book"></i>
                                    <span>Bình luận khách hàng</span>
                                </a>
                            </li>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-book"></i>
                                    <span>Slider</span>
                                </a>
                                <ul class="sub">
                                    <li><a href="{{ URL::to('/add-slider') }}">Thêm slider</a></li>
                                    <li><a href="{{ URL::to('/manage-slider') }}">Danh sách slider</a></li>
                                </ul>
                            </li>
                        @endhasrole
                        @hasrole('admin')
                            <li class="sub-menu">
                                <a href="{{ URL::to('/all-contact') }}">
                                    <i class="fa fa-book"></i>
                                    <span>Thông tin liên hệ</span>
                                </a>

                            </li>
                        @endhasrole

                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                @yield('admin_content')

            </section>
            <!-- footer -->
            <!-- <div class="footer">
<div class="wthree-copyright">
<p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
</div>
</div> -->
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>
    <script src="{{ asset('public/backend/js/bootstrap.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('public/backend/js/scripts.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('public/backend/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.form-validator.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.2/chart.min.js"
        integrity="sha512-zjlf0U0eJmSo1Le4/zcZI51ks5SjuQXkU0yOdsOBubjSmio9iCUp8XPLkEAADZNBdR9crRy3cniZ65LF2w8sRA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('public/backend/js/custom-admin.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function() {

            fetch_delivery();

            function fetch_delivery() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/select-feeship') }}',
                    method: 'POST',
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        $('#load_delivery').html(data);
                    }
                });
            }
            $(document).on('blur', '.fee_feeship_edit', function() {

                var feeship_id = $(this).data('feeship_id');
                var fee_value = $(this).text();
                var _token = $('input[name="_token"]').val();
                // alert(feeship_id);
                // alert(fee_value);
                $.ajax({
                    url: '{{ url('/update-delivery') }}',
                    method: 'POST',
                    data: {
                        feeship_id: feeship_id,
                        fee_value: fee_value,
                        _token: _token
                    },
                    success: function(data) {
                        fetch_delivery();
                    }
                });

            });
            $('.add_delivery').click(function() {

                var city = $('.city').val();
                var province = $('.province').val();
                var wards = $('.wards').val();
                var fee_ship = $('.fee_ship').val();
                var _token = $('input[name="_token"]').val();
                // alert(city);
                // alert(province);
                // alert(wards);
                // alert(fee_ship);
                $.ajax({
                    url: '{{ url('/insert-delivery') }}',
                    method: 'POST',
                    data: {
                        city: city,
                        province: province,
                        _token: _token,
                        wards: wards,
                        fee_ship: fee_ship
                    },
                    success: function(data) {
                        fetch_delivery();
                    }
                });


            });
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
                    url: '{{ url('/select-delivery') }}',
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
        $('.order_details').change(function() {
            var order_status = $(this).val();
            var order_id = $(this).children(":selected").attr("id");
            var _token = $('input[name="_token"]').val();

            quantity = []
            $('input[name="product_sales_quantity"]').each(function() {
                quantity.push($(this).val())
            })

            order_product_id = []
            $('input[name="order_product_id"]').each(function() {
                order_product_id.push($(this).val())
            })

            j = 0;
            for (i = 0; i < order_product_id.length; i++) {
                //SL hàng khách đặt
                var order_qty = $('.order_qty_' + order_product_id[i]).val();
                //SL hàng trong kho
                var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

                if (parseInt(order_qty) > parseInt(order_qty_storage)) {
                    j = j + 1;
                    if (j == 1) {
                        alert('Số lượng bán trong kho không đủ');
                    }
                    $('.color_qty_' + order_product_id[i]).css('background', '#dc3545');
                }
            }
            if (j == 0) {
                $.ajax({
                    url: '{{ url('/update-order-qty') }}',
                    method: 'POST',
                    data: {
                        _token: _token,
                        order_status: order_status,
                        order_id: order_id,
                        quantity: quantity,
                        order_product_id: order_product_id
                    },
                    success: function(data) {
                        alert('Cập nhật tình trạng đơn hàng thành công');
                        location.reload();
                    }
                });
            }

        });
        //
    </script>
    <script type="text/javascript">
        $('.update_quantity_order').click(function() {
            var order_product_id = $(this).data('product_id');
            var order_qty = $('.order_qty_' + order_product_id).val();
            var order_code = $('.order_code').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ url('/update-qty') }}',

                method: 'POST',

                data: {
                    _token: _token,
                    order_product_id: order_product_id,
                    order_qty: order_qty,
                    order_code: order_code
                },
                // dataType:"JSON",
                success: function(data) {
                    alert('Cập nhật số lượng thành công');
                    location.reload();
                }
            });

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            loadGallery()

            function loadGallery() {
                var product_id = $('.product_id').val()
                var _token = $('input[name="_token"]').val()
                $.ajax({
                    url: '{{ url('/select-gallery') }}',
                    method: 'POST',
                    data: {
                        product_id: product_id,
                        _token: _token,
                    },
                    success: function(data) {
                        $('#gallery-load').html(data);
                    }
                })
            }

            $('#gallery_files').change(function() {
                var error = ''
                var files = $('#gallery_files')[0].files
                if (files.length > 5) {
                    error = 'Bạn chỉ được chọn 5 ảnh'
                } else if (files.length == '') {
                    error = 'Không được bỏ trống'
                } else if (files.size > 2000000) {
                    error = 'File ảnh không được lớn hơn 2MB'
                }

                if (error == '') {

                } else {
                    $('#gallery_files').val('')
                    $('#error_gallery').html(`<p class="alert alert-danger">${error}</p>`)
                    return false
                }
            })
            $(document).on('blur', '.edit_gal_name', function() {
                var gal_id = $(this).data('gal_id')
                var gal_text = $(this).text()
                var _token = $('input[name="_token"]').val()

                $.ajax({
                    url: '{{ url('/update-gallery-name') }}',
                    method: 'POST',
                    data: {
                        gal_id: gal_id,
                        gal_text: gal_text,
                        _token: _token,

                    },
                    success: function(data) {
                        loadGallery()
                        $('#error_gallery').html(
                            `<p class="alert alert-success">Cập nhật tên hình ảnh thành công!</p>`
                        )

                    }
                })
            })
            $(document).on('click', '.delete_gallery', function() {
                var gal_id = $(this).data('gallery_id')
                var _token = $('input[name="_token"]').val()
                if (confirm('Bạn muốn xóa hình ảnh này không?')) {
                    $.ajax({
                        url: '{{ url('/remove-gallery') }}',
                        method: 'POST',
                        data: {
                            gal_id: gal_id,
                            _token: _token,

                        },
                        success: function(data) {
                            loadGallery()
                            $('#error_gallery').html(
                                `<p class="alert alert-success">Xóa hình ảnh thành công!</p>`
                            )

                        }
                    })
                }
            })

        })
    </script>
    <script>
        $(function() {
            $("#datepicker").datepicker({
                prevText: 'Tháng trước',
                nextText: 'Tháng sau',
                dateFormat: 'yy-mm-dd',
                dayNamesMin: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
                monthNames: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7",
                    "Tháng 8",
                    "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
                ],
                duration: 'slow'
            });
        });
        $(function() {
            $("#datepicker2").datepicker({
                prevText: 'Tháng trước',
                nextText: 'Tháng sau',
                dateFormat: 'yy-mm-dd',
                dayNamesMin: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
                monthNames: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7",
                    "Tháng 8",
                    "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
                ],
                duration: 'slow'
            });
        });
        $(function() {
            $("#coupon-date-start").datepicker({
                prevText: 'Tháng trước',
                nextText: 'Tháng sau',
                dateFormat: 'yy-mm-dd',
                dayNamesMin: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
                monthNames: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7",
                    "Tháng 8",
                    "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
                ],
                duration: 'slow'
            });
        });
        $(function() {
            $("#coupon-date-end").datepicker({
                prevText: 'Tháng trước',
                nextText: 'Tháng sau',
                dateFormat: 'yy-mm-dd',
                dayNamesMin: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
                monthNames: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7",
                    "Tháng 8",
                    "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
                ],
                duration: 'slow'
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            var chart = new Morris.Area({
                element: 'myfirstchart',
                // Chart data records -- each entry in this array corresponds to a point on
                // the chart.
                // The name of the data record attribute that contains x-values.
                xkey: 'year',
                // A list of names of data record attributes that contain y-values.
                ykeys: ['value'],
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['Value']
            });

            $('#btn-dashboard-filter').click(function() {
                var _token = $('input[name="_token"]').val()
                var from_date = $('#datepicker').val()
                var to_date = $('#datepicker2').val()

                $.ajax({
                    // url: '{{ url('/filter-by-date') }}',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        from_date: from_date,
                        to_date: to_date,
                        _token: _token,

                    },
                    success: function(data) {
                        chart.setData(JSON.parse(data))
                    }
                })
            })
        })
    </script>

    <script>
        var proCountArr = []
        var hiddenProduct = $('.hidden-product-dash')
        $.each(hiddenProduct, function(key, item) {
            proCountArr.push(item.value)
        })
        var labels = [
            'Số sản phẩm đã bán',
            'Số sản phẩm còn lại trong kho'
        ];

        var data = {
            labels: labels,
            datasets: [{
                label: 'My Sale Dataset',
                data: proCountArr,
                backgroundColor: [
                    'rgb(54, 162, 235)',
                    'rgb(255, 99, 132)',
                ],
                hoverOffset: 4
            }]
        };

        var config = {
            type: 'doughnut',
            data: data,
            options: {

            }
        };
        var myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
    <script>
        var brandName = $.map($('.hidden-brand-qty'), function(el) {
            return $(el).data('brandname')

        });
        var brandQty = $.map($('.hidden-brand-qty'), function(el) {
            return $(el).data('brandqty')

        });

        var labelBrand = brandName;

        var dataBrand = {
            labels: labelBrand,
            datasets: [{
                label: 'My Brand Dataset',
                data: brandQty,
                backgroundColor: [
                    'rgb(54, 162, 235)',
                    'rgb(255, 99, 132)',
                    'rgb(117,54,211)',
                    '#4acf81', '#f1c65b', '#dc3545', '#56c2e6', 'blue',
                    '#28a745'
                ],
                hoverOffset: 4
            }]
        };

        var configBrand = {
            type: 'doughnut',
            data: dataBrand,
            options: {

            }
        };
        var myChart = new Chart(
            document.getElementById('myBrandQty'),
            configBrand
        );
    </script>
    <script>
        var categoryName = $.map($('.hidden-category-qty'), function(el) {
            return $(el).data('categoryname')

        });
        var categoryQty = $.map($('.hidden-category-qty'), function(el) {
            return $(el).data('categoryqty')

        });

        var labelCategory = categoryName;

        var dataCategory = {
            labels: labelCategory,
            datasets: [{
                label: 'My Category Dataset',
                data: categoryQty,
                backgroundColor: [
                    'rgb(54, 162, 235)',
                    'rgb(255, 99, 132)',
                    'rgb(117,54,211)',
                    '#4acf81', '#f1c65b', '#dc3545', '#56c2e6', 'blue',
                    '#28a745'
                ],
                hoverOffset: 4
            }]
        };

        var configCategory = {
            type: 'doughnut',
            data: dataCategory,
            options: {

            }
        };
        var myChart = new Chart(
            document.getElementById('myCategoryQty'),
            configCategory
        );
    </script>

    <script>
        $(document).ready(function() {
            $('.btn-reply-comment').click(function() {
                // var comment = $('.reply-comment').val()
                // var comment_id = $(this).data('comment_id')
                // var comment_product_id = $(this).data('comment-product-id')

                // var notifyReply = "Bạn đã trả lời bình luận"
                // alert(comment)
                // alert(comment_id)
                // alert(comment_product_id)
                alert(123)
                // $.ajax({
                // url: '{{ url('/send-comment') }}',
                // method: 'POST',
                // data: {
                //     product_id: product_id,
                //     comment_name: comment_name,
                //     comment_content: comment_content,
                //     _token: _token,
                // },
                // success: function(data) {
                //     loadComment()
                // }
                // })
            })
        })
    </script>
    <script>
        $('.btn-reply-comment').click(function() {
            var comment_id = $(this).data('comment-id')
            var comment = $('.reply-comment-' + comment_id).val()
            var comment_product_id = $(this).data('comment-product-id')
            var _token = $('input[name="_token"]').val();

            var notifyReply = "Bạn đã trả lời bình luận"

            $.ajax({
                url: '{{ url('/reply-comment') }}',
                method: 'POST',
                data: {
                    comment: comment,
                    comment_id: comment_id,
                    comment_product_id: comment_product_id,
                    _token: _token
                },
                success: function(data) {
                    $('#notify-reply-comment').html(
                        '<span>Trả lời bình luận thành công</span>')
                }
            })
        })
    </script>

    <script>
        // CKEDITOR: replace('ckeditor')
        CKEDITOR.replace('product-desc')
        // CKEDITOR.replace('product-content')
    </script>
    {{-- <script type="text/javascript">
        $.validate({

        })
    </script> --}}
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->

</body>

</html>
