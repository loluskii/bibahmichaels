<!doctype html>
<html lang="en">

<head>
    <title>:: Lucid :: Home</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Bibah Michael">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <link rel="stylesheet"
        href="https://www.wrraptheme.com/templates/lucid/html/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://www.wrraptheme.com/templates/lucid/html/assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet"
        href="https://www.wrraptheme.com/templates/lucid/html/assets/vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css">
    <link rel="stylesheet" href="https://www.wrraptheme.com/templates/lucid/html/assets/vendor/toastr/toastr.min.css">

    <link rel="stylesheet" href="{{ secure_asset('admin/css/main.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('admin/css/color_skins.css') }}">


</head>

<body class="theme-cyan">
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img src="https://www.wrraptheme.com/templates/lucid/html/assets/images/logo-icon.svg"
                    width="48" height="48" alt="Lucid"></div>
            <p>Please wait...</p>
        </div>
    </div>

    <div class="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle auth-main">
                @yield('content')
            </div>
        </div>
    </div>


    <!-- Bootstrap JavaScript Libraries -->
    @include('admin.layout.footer-scripts')
    <script src="{{ secure_asset('admin/bundles/mainscripts.bundle.js') }}"></script>
</body>

</html>
