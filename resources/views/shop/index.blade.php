@extends('layouts.app')

@section('css')
<style>
    .product-image {
        background-color: #cccccc;
        height: 350px;
        width: auto;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }

    .radio input[type="radio"] {
        display: none;
    }

    .radio label {
        padding-left: 0;
    }

    .radio label:before {
        content: "";
        display: inline-block;
        vertical-align: middle;
        margin-right: 15px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 10px solid #eee;
        background-color: #333333;
    }

    .radio input[type="radio"]:checked+label:before {
        border-width: 7px;
    }

    .checkbox-content {
        /* border-radius: 5px; */
        /* border: solid 2px transparent; */
        /* background: #fff; */
        /* padding: 10px; */
        transition: .3s ease-in-out all;
        height: 100%;
    }


    .checkbox-label {
        position: relative;
        border-radius: 5px;
    }

    .checkbox-label input {
        display: none;
    }

    .checkbox-label .icon {
        width: 10px;
        height: 10px;
        border: solid 2px #e3e3e3;
        border-radius: 50%;
        position: absolute;
        top: 19px;
        left: 10px;
        transition: .3s ease-in-out all;
        transform: scale(1);
        z-index: 1;
        visibility: hidden;
    }

    .checkbox-label input:checked+.icon {
        background: #2A707D;
        border-color: #2A707D;
        transform: scale(1.2);
        visibility: visible;
    }


    .checkbox-label input:checked+.icon:before {
        color: #fff;
        opacity: 1;
        /* transform: scale(.8); */
    }

    .checkbox-label input:checked~.checkbox-content {
        box-shadow: 0 2px 4px 0 rgba(219, 215, 215, 0.5);
        /* border: solid 1px #2A707D; */
        /* color: #2A707D; */
    }

    .checkbox-label input:checked~.checkbox-content h6 {
        margin-left: 20px;
        transition: .3s ease-in-out all;
    }
</style>
@endsection

@section('content')
<div class="">
    <div class="top-section text-center py-5 border-bottom">
        <h3 class="text-uppercase">{{ $collection_title ?? 'PRODUCTS' }}</h3>
    </div>
    <div class="container-sm py-5">
        <div class="row">
            <div class="col-md-2">

                <form action="{{ Route::is('shop') ? '' : route('shop') }}" id="productsFilter">
                    <div class="price"></div>
                    <div class="category">
                        <h6>CATEGORY</h6>
                        @foreach ($categories as $category)
                        <label class="checkbox-label w-100">
                            <input type="radio" value="{{ $category->slug }}" onclick="this.form.submit()"
                                name="category" />
                            {{-- <span class="icon"></span> --}}
                            <div class="checkbox-content">
                                <p class="font-weight-bold mb-1">{{ $category->name }}</p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </form>
            </div>
            <div class="col-md-10">
                <div class="row">
                    @if ($products->count() > 0)
                        @foreach ($products as $product)
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
                        <div class="col-md-3 mb-3">
                            <a class=" text-decoration-none" href="{{ route('shop.product.show',$product->slug) }}">
                                <div class="card rounded-0 border-0">
                                    <div class="product-image"
                                        style="background-image: url('{{ $product->images()->first()->url ?? '' }}')"></div>
                                    <div class="card-body text-center text-decoration-none">
                                        <h5 class="card-title text-uppercase  text-decoration-none">{{ $product->name }}
                                        </h5>
                                        <p class="card-text ">{{ $currency_symbol }}{{
                                            number_format(App\Helpers\Helper::currency_converter($product->price), 2) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    @else
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12 text-center">
                                    <div class="mb-4 lead">Oops! No products available!</div>
                                    <a href="{{ route('home') }}" class="btn btn-link">Back to Home</a>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
