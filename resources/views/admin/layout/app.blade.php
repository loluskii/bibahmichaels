<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="{{ secure_asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ secure_asset('admin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('admin/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('admin/css/style.css') }}" rel="stylesheet">


</head>

<body>
    <!-- ======= Header ======= -->
    @include('admin.layout.header')
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('admin.layout.sidebar')
    <!-- End Sidebar-->

    <main id="main" class="main">
        <div class="pagetitle">
            @yield('page-title')
        </div>
        <section class="section dashboard">
            @yield('content')
        </section>
    </main>
    <!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="{{ secure_asset('admin/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ secure_asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ secure_asset('admin/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ secure_asset('admin/js/main.js') }}"></script>
</body>

</html>
