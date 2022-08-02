<!doctype html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap"
        rel="stylesheet">
    <style>
        header.header {
            letter-spacing: 4px;
        }

        .mobile, .desktop{
            letter-spacing: normal;
        }

        .navbar-brand img {
            height: 60px;
        }

        @media (max-width: 600px) {
            .navbar-brand img {
                height: 50px;
            }
        }

        span.bage{
            bottom: 10px;
            transition: all .3s ease-in-out;
        }
    </style>
    @yield('css')
</head>

<body>
    <div class="main">
        @if (Route::is('checkout.*'))
        @else
        <header class="header border-bottom">
            <div class="top py-4 bg-dark">

            </div>
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg bg-white py-1">
                    <div class="row gx-0 w-100 align-items-center">
                        <div class="col-3 col-md-3 text-start">
                            <button class="navbar-toggler d-lg-none" type="button" aria-controls="collapsibleNavId"
                                aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 448 512">
                                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                    <path
                                        d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z" />
                                </svg>
                            </button>
                        </div>
                        <div class="col-6 col-md-6 text-center">
                            <a class="navbar-brand me-0" href="/">
                                <img src="{{ asset('logo.svg') }}" class="d-inline-block align-text-top" alt=""
                                    srcset="">
                            </a>
                        </div>
                        <div class="col-3 col-md-3 text-end">
                            <div class="d-flex justify-content-end align-items-center mobile d-lg-none">
                                <i class="bi bi-search me-3" style="font-size: 20px"></i>
                                <div>
                                    <i class="bi bi-bag" style="font-size: 20px"></i>
                                    <span class="position-absolute bage start-100 translate-middle p-1 bg-dark border border-light rounded-circle"></span>
                                </div>
                            </div>
                            <div class="desktop d-none d-lg-block">
                                <ul class="list-unstyled d-flex justify-content-end mb-0">
                                    <li><a href="{{ route('user') }}" class="text-decoration-none mx-3 text-uppercase" style="font-weight: 300">Account</a></li>
                                    <li><a href="{{ route('shop.cart') }}" class="text-decoration-none mx-3 text-uppercase"  style="font-weight: 300">Cart ( {{ Cart::session('guest')->getContent()->count() }} )</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>

                <nav class="navbar navbar-expand-lg bg-light d-none d-md-block d-lg-block">
                    {{-- <a class="navbar-brand me-0" href="#">
                        SUBSCRIBE
                    </a> --}}
                    <div class="collapse navbar-collapse" id="navbarScroll">
                        <ul class="navbar-nav mx-auto my-2 my-lg-0 navbar-nav-scroll"
                            style="--bs-scroll-height: 100px;">
                            <li class="nav-item mx-4">
                                <a class="nav-link" aria-current="page" href="{{ route('home') }}">HOME</a>
                            </li>
                            <li class="nav-item mx-4">
                                <a class="nav-link" href="{{ route('shop') }}">BIBAH STUDIOS</a>
                            </li>

                            <li class="nav-item mx-4">
                                <a href="{{ route('bridal') }}" class="nav-link">BRIDAL</a>
                            </li>
                            <li class="nav-item mx-4">
                                <a href="{{ route('bespoke') }}" class="nav-link">BESPOKE</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('contact') }}" class="nav-link">CONTACT</a>
                            </li>
                        </ul>
                        {{-- <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form> --}}
                    </div>
                </nav>
            </div>

        </header>
        @endif

        <div class="content">
            @yield('content')
        </div>
        <div class="footer border-top">
            @include('layouts.footer')
        </div>
    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>


    @yield('scripts')

</body>

</html>
