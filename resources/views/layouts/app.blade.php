<!doctype html>
<html lang="en">

<head>
    <title>Bibah Michael | BM</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bridal Wears, Online Shopping, Online Fashion, fashion, fashion stores, bibah michael">
    <meta name="application-name" content="www.bibahmichael.co.uk">
    <meta name="description" content="Come join me. Let's go shopping!">
    <meta property="og:image" content="{{ secure_asset('images/favicon/android-chrome-512x512.png') }}" />
    <meta property="og:image:secure_url" content="{{ secure_asset('images/favicon/android-chrome-512x512.png') }}" />
    <meta property="og:image:type" content="image/png" />
    {{-- <meta property="og:description" content="Shop Bibah Michael Today!" /> --}}
    <meta name="google" content="nopagereadaloud" />
    <meta property="og:title" content="Shop your best wears on Bibah Michael" />
    <meta property="og:url" content="http://www.bibahmichael.co.uk" />
    <meta property="og:site_name" content="bibahMichael" />
    <meta property="og:type" content="website" />
    <meta name="twitter:card" content="summary_large_image" />

    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/bootstrap-side-modals.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/style.css') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ secure_asset('images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ secure_asset('images/favicon/site.webmanifest') }}">
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

        header .top {
            letter-spacing: normal;
        }

        .mobile,
        .desktop {
            letter-spacing: normal;
        }

        .navbar-brand img {
            height: 40px;
        }

        @media (max-width: 600px) {
            .navbar-brand img {
                height: 50px;
            }
        }

        .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 5px;
        }

        span.bage {
            bottom: 10px;
            transition: all .3s ease-in-out;
        }

        .nav-item::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background: #000;
            transition: width .3s;
        }

        .nav-item:hover::after {
            width: 100%;
            // transition: width .3s;
        }
    </style>
    @yield('css')
</head>

<body>
    <div class="main">
        @if (Route::is('checkout.*') || Route::is('coming-soon'))

        @else
        <header class="header border-bottom">
            <div class="d-flex align-items-center justify-content-between top py-2 bg-dark px-2 px-lg-5 px-md">
                <p class="mb-0 text-white text-decoration-underline" style="cursor: pointer;"  data-bs-toggle="modal" data-bs-target="#size-chart">Size Chart</p>
                @include('partials.size-chart')
                <div class="col-auto">
                    <select class="form-select form-select-sm rounded-0 bg-transparent text-white" name="currency" id="currency">
                        @php
                        $currencies = App\Models\Currency::where('status','active')->get();
                        App\Helpers\Helper::currency_load();
                        $currency_code = session('currency_code');
                        $currency_symbol = session('currency_symbol');
                        if($currency_symbol == ""){
                        $system_default_currency_info = session('system_default_currency_info');
                        $currency_symbol = $system_default_currency_info->symbol;
                        $currency_code = $system_default_currency_info->code;
                        }
                        @endphp
                        @foreach ($currencies as $currency)
                        <option class="text-dark" {{ ($currency_code==$currency->code) ? 'selected' : '' }} value="{{ $currency->code
                            }}">{{ $currency->icon }} {{ $currency->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg bg-white py-1">
                    <div class="row gx-0 w-100 align-items-center">
                        <div class="col-2 col-md-2 text-start">
                            <button class="navbar-toggler d-lg-none" data-bs-toggle="modal" data-bs-target="#mobileSideNav" type="button" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 448 512">
                                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                    <path
                                        d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z" />
                                </svg>
                            </button>
                        </div>
                        <div class="col-8 col-md-8 text-center">
                            <a class="navbar-brand me-0" href="/">
                                <img src="{{ secure_asset('2.png') }}" class="d-inline-block align-text-top" alt=""
                                    srcset="">
                            </a>
                        </div>
                        <div class="col-2 col-md-2 text-end">
                            <div class="d-flex justify-content-end align-items-center mobile d-lg-none">
                                <i class="bi bi-search me-3" style="font-size: 20px"></i>
                                <div>
                                    <a data-bs-toggle="modal" data-bs-target="#modelId">
                                        <i class="bi bi-bag" style="font-size: 20px"></i>
                                        <span class="position-absolute bage start-100 translate-middle p-1 bg-dark border border-light rounded-circle {{ \Cart::session(App\Helpers\Helper::getSessionID())->getContent()->count() > 0 ? '' : 'd-none'}}" ></span>
                                    </a>
                                </div>
                            </div>
                            <div class="desktop d-none d-lg-block">
                                <ul class="list-unstyled d-flex justify-content-end mb-0">
                                    <li><a href="{{ route('user') }}" class="text-decoration-none mx-3 text-uppercase"
                                            style="font-weight: 300">Account</a></li>
                                    <li><a href="{{ route('shop.cart') }}"
                                            class="text-decoration-none mx-3 text-uppercase"
                                            style="font-weight: 300">Cart ({{
                                            Cart::session(App\Helpers\Helper::getSessionID())->getContent()->count() }})</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>

                <nav class="navbar navbar-expand-lg bg-light d-none d-lg-block py-0">
                    {{-- <a class="navbar-brand me-0" href="#">
                        SUBSCRIBE
                    </a> --}}
                    <div class="collapse navbar-collapse" id="navbarScroll">
                        <ul class="navbar-nav mx-auto my-2 my-lg-0 navbar-nav-scroll"
                            style="--bs-scroll-height: 100px;">
                            <li class="nav-item mx-4">
                                <a class="nav-link" aria-current="page" href="{{ route('home') }}">HOME</a>
                            </li>
                            <li class="nav-item dropdown mx-4">
                                <a class="nav-link" role="button" href="{{ route('shop') }}">SHOP</a>
                                <ul class="dropdown-menu border-0 shadow" style="letter-spacing: normal;">
                                    @foreach (App\Models\Category::all() as $item)
                                    <li><a class="dropdown-item" href="{{ route('shop.category',$item->slug) }}">{{
                                            $item->name }}</a></li>
                                    @endforeach
                                    {{-- <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                                </ul>
                            </li>


                            <li class="nav-item mx-4">
                                <a href="{{ route('custom') }}" class="nav-link">CUSTOM ORDER</a>
                            </li>
                            <li class="nav-item mx-4">
                                <a href="{{ route('gallery') }}" class="nav-link">GALLERY</a>
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
        @include('partials.mobile-nav')
        @include('partials.cart-modal')
        @endif
        @if (Route::is('home'))
            {{-- @include('partials.shop-with-bm-modal') --}}
        @else

        @endif
        <div class="content">
            @yield('content')
        </div>
        @if (Route::is('checkout.*') || Route::is('coming-soon'))

        @else
        <div class="footer border-top">
            @include('layouts.footer')
        </div>
        @endif
    </div>


    <script src="{{ secure_asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript">
    </script>
    <script>
        $(document).ready(function (){
            $("#myModal").modal('show');
            $('#currency').on('change',function (){
                var currency_code = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('currency.load') }}",
                    data: {
                        currency_code: currency_code,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response){
                        if(response['status']){
                            location.reload();
                        }else{
                            console.log(response);
                            alert('server error');
                        }
                    }
                })
            });
            // $('.dropdown').hover(function() {
            //     $('.dropdown-toggle',this).addClass('show');
            // },
            // function() {
            //     $('.dropdown-toggle',this).removeClass('show');
            // });
        })
    </script>


    @yield('scripts')

</body>

</html>
