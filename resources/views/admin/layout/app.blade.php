<!doctype html>
<html lang="en">

<head>
    <title>Home</title>
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
    <link rel="stylesheet"
        href="https://www.wrraptheme.com/templates/lucid/html/assets/vendor/chartist/css/chartist.min.css">
    <link rel="stylesheet"
        href="https://www.wrraptheme.com/templates/lucid/html/assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">
    <link rel="stylesheet" href="https://www.wrraptheme.com/templates/lucid/html/assets/vendor/toastr/toastr.min.css">

    <link rel="stylesheet" href="{{ secure_asset('admin/css/main.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('admin/css/color_skins.css') }}">
    @yield('styles')


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
        @include('admin.layout.header')
        @include('admin.layout.sidebar')

        <div id="main-content">
            <div class="container-fluid">
                <div class="block-header">
                    <h2 class="float-start mb-3"> @yield('title')</h2>
                    <div class="row justify-content-center">

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="{{ secure_asset('admin/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ secure_asset('admin/bundles/vendorscripts.bundle.js') }}"></script>
    <script src="{{ secure_asset('admin/bundles/morrisscripts.bundle.js') }}"></script>
    <script src="{{ secure_asset('admin/bundles/knob.bundle.js') }}"></script>
    <script src="{{ secure_asset('admin/bundles/mainscripts.bundle.js') }}"></script>
    <script src="{{ secure_asset('admin/js/index8.js') }}"></script>

    @yield('scripts')
</body>

</html>
