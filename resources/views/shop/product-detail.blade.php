@extends('layouts.app')

@section('css')
<style>
    .container {
        padding-top: 75px;
        padding-bottom: 75px;
    }

    .main-content {
        padding-bottom: 200px;
    }

    @media (max-width:578px) {
        .main-content {
            padding-bottom: 75px;
        }
    }

    .thumbnail {
        /* background-color: #cccccc; */
        height: 145px;
        width: auto;
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
        position: relative;
        padding: 60px;
    }

    #product-image {
        height: 600px;
        width: 500px;
        background-color: #cccccc;
        object-fit: cover;
    }


    .cat {
        margin: 4px;
        background-color: transparent;
        color: #BBBBBB;
        overflow: hidden;
        float: left;
        border: 1px solid #BBBBBB;
    }

    .cat label {
        float: left;
        min-width: 51px;
        height: 100%;

    }

    .cat label span {
        text-align: center;
        padding: 5px 15px;
        display: block;
        align-items: center;
        height: 100%;
        color: #bbb;
        font-weight: 500;
    }

    .cat label input {
        position: absolute;
        display: none;
        color: #fff !important;
    }

    .cat input:checked+span {
        color: #121212;
        border: 1px solid #121212;
    }

    #button-addon1 {
        border-top: 1px solid #ced4da;
        border-left: 1px solid #ced4da;
        border-bottom: 1px solid #ced4da;
    }

    #button-addon2 {
        border-top: 1px solid #ced4da;
        border-right: 1px solid #ced4da;
        border-bottom: 1px solid #ced4da;
    }

    li.nav-item .nav-link.active {
        color: #121212;
        background-color: transparent;
        /* border-bottom: 2px solid #121212; */
        font-weight: 600;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="border-0 mb-5">
        <div class="row main-content">
            <aside class="col-md-6 text-center pb-3 pb-md-3 pb-lg-3 pb-xl-3">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 order-lg-first order-md-first order-last">
                        <div
                            class="img-small-wrap d-flex justify-content-between align-items-center flex-lg-column flex-md-column flex-sm-row order-lg-1 mt-lg-0 mt-md-0 mt-3">
                            @foreach ($product->images->take(3) as $image)
                            <div class="item-gallery d-flex align-items-center ">
                                <a href="#" class="thumbnail mb-3" data-big="{{ $image->url ?? '' }}"
                                    style="background-image: url('{{ $image->url ?? '' }}')"></a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 order-lg-last order-md-last order-first product-image">
                        <img src="{{ $product->images()->first()->url ?? '' }}" id="product-image" style=""
                            class="primary img-fluid">
                        {{-- <div class="prodcut-image"></div> --}}
                    </div>
                </div>
            </aside>
            <aside class="col-md-6">
                <article class="card-body px-lg-5 px-md-5 p-sm-2 py-0">
                    <header
                        class="d-flex flex-lg-column flex-md-column flex-column align-items-lg-start align-items-md-start">
                        <p class=" text-decoration-underline" style="cursor: pointer;"  data-bs-toggle="modal" data-bs-target="#size-chart">Size Chart <i class="fa-solid fa-ruler"></i></p>
                        <h4 class="text-uppercase me-md-auto me-lg-auto me-xl-auto fw-bold">{{ $product->name }}</h4>
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
                        <p class="price-detail-wrap">
                            <span class="price h6" style="font-weight: 500">
                                <span class="num font-weight-bold">{{ $currency_symbol }}{{ number_format(App\Helpers\Helper::currency_converter($product->price), 2) }}</span>
                            </span>
                        </p>
                    </header>
                    <form id="addToCart" class="pt-2 pt-md-4 pt-lg-4 pt-xl-4" action="{{ route('cart.add',$product->id) }}" method="post">
                        @csrf

                        @foreach ($group as $key => $item)
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label text-uppercase">{{ $key }}</label>
                                <div
                                    class="d-flex justify-content-md-start justify-content-lg-start justify-content-xl-start justify-content-center mb-3">
                                    @foreach ($item as $value)
                                    <div class="cat action">
                                        <label>
                                            <input type="radio" name="{{ $key }}" value="{{ $value->value }}"><span
                                                class="text-uppercase">{{
                                                $value->value }}</span>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-6 col-md-4">
                                <label for="inputPassword6" class="col-form-label text-uppercase">QUANTITY</label>
                                <div class="input-group mb-3">
                                    <button class="btn px-2 btn-sm rounded-0 minus fw-bold" style="color: #bbb"
                                        type="button" id="button-addon1">-</button>
                                    <input type="text" value="1" name="quantity" readonly
                                        class="bg-white form-control text-center border-start-0 border-end-0"
                                        aria-label="Amount (to the nearest dollar)">
                                    <button class="btn btn-sm px-2 plus rounded-0 fw-bold" style="color: #bbb"
                                        type="button" id="button-addon2">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-lg-row flex-md-row flex-column g-2">
                            <button type="submit" class="btn btn-dark rounded-0 me-sm-3 mb-3 px-5">ADD TO CART</button>
                            <button type="submit" id="buyNow" class="btn btn-outline-dark rounded-0 mb-3 px-5">BUY
                                NOW</button>
                        </div>
                    </form>
                </article>
            </aside>
        </div>
        <div class="row">
            <div class="col-12 col-md-9 col-lg-9 mx-auto">
                <ul class="border-bottom nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item me-md-5 me-5" role="presentation">
                        <button class="nav-link active rounded-0" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">Description</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-0" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">More Information</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active text-center" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab">
                        <p>{{ $product->description}}</p>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <p>{{ $product->additional_information }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container border-top">
    <div class="pt-3 pb-5">
        <div class="text-center pb-5">

            <h4>YOU MAY LIKE THESE</h4>
        </div>
        <div class="row justify-content-center">
            @if ($similar->count() > 0)
                @foreach ($similar as $product)
                <div class="col-md-3 mb-3">
                    <a class=" text-decoration-none" href="{{ route('shop.product.show',$product->slug) }}">
                        <div class="card rounded-0 border-0">
                            <div class="product-image" style="background-image: url('{{ $product->images()->first()->url ?? '' }}')"></div>
                            <div class="card-body text-center text-decoration-none">
                                <h5 class="card-title text-uppercase  text-decoration-none">{{ $product->name }}</h5>
                                <p class="card-text ">{{ $currency_symbol }}{{
                                    number_format(App\Helpers\Helper::currency_converter($product->price), 2) }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            @else
                <p>No similar products. </p>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function (){
        $('.minus').click(function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();
            return false;
        });
        $('.plus').click(function () {
            var $input = $(this).parent().find('input');
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            return false;
        });
        $("#buyNow").on("click", function () {
            $('#addToCart').append("<input type='hidden' name='buy_now' value='true'/>");
        });
        $('.thumbnail').on('click', function(e) {
            console.log('clicked');
            var clicked = $(this);
            var newSelection = clicked.data('big');
            console.log(newSelection);
            var $img = $('.primary').attr("src", newSelection);
            // clicked.parent().find('.thumbnail').removeClass('selected');
            // clicked.addClass('selected');
            $('.primary').empty().append($img.hide().fadeIn());

        });
    })
</script>
@endsection
