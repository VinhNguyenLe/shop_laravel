<!DOCTYPE html>

<head>
    <title>Đăng Nhập</title>
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
    <link rel="shortcut icon" href="https://f7-zpcloud.zdn.vn/8694182849937176588/c6f480b37442b61cef53.jpg"
        type="image/x-icon">

    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/font.css') }}" type="text/css" />
    <link href="{{ asset('public/backend/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('public/backend/css/custom.css') }}" rel='stylesheet' type='text/css' />

    <!-- //font-awesome icons -->
    <script src="{{ asset('public/backend/js/jquery2.0.3.min.js') }}"></script>
</head>

<body>
    <div class="log-w3">
        <div class="custom-login-admin">
            <div class="w3layouts-main custom-admin-login" style="margin-block: unset">
                <h2>Đăng nhập</h2>

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
                <form action="{{ URL::to('/login') }}" method="post">
                    {{ csrf_field() }}
                    <input type="email" class="ggg" name="admin_email" placeholder="Email đăng nhập" required>
                    <input type="password" class="ggg" name="admin_password" placeholder="Mật khẩu" required>

                    <div class="clearfix"></div>
                    <input type="submit" value="Đăng nhập" name="login" class="custom-login-btn">
                </form>
                {{-- <a href="{{URL::to('/login-google')}}">Đăng nhập bằng Google</a> --}}
                <div>
                    {{-- style="display: flex; justify-content: space-between" --}}
                    {{-- <a href="{{ URL::to('/admin') }}">Đăng nhập Admin</a> --}}
                    {{-- <a href="{{ URL::to('/register-auth') }}">Đăng ký</a> --}}
                </div>
                <!-- <p>Don't Have an Account ?<a href="registration.html">Create an account</a></p> -->
            </div>
        </div>
    </div>
    <script src="{{ asset('public/backend/js/bootstrap.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('public/backend/js/scripts.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.nicescroll.js') }}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{ asset('public/backend/js/jquery.scrollTo.js') }}"></script>
</body>

</html>
