@extends('layouts.app')

@section('css')
<style>
    .main-header {
        background-image: url("{{ asset('images/pexels-godisable-jacob-923210.jpg') }}");
        background-color: #cccccc;
        height: 700px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        padding: 60px;
    }

    .jumbotron{
        background-image: url("{{ asset('images/pexels-godisable-jacob-928000.jpg') }}");
        background-color: #cccccc;
        /* height: 700px; */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        padding: 60px;
        border-radius: 0;
    }
    .header-text {
        position: absolute;
        top: 55%;
        color: white;
        text-transform: uppercase;
        width: 600px;
    }

    .header-text h3 {
        font-weight: bolder;
        font-size: 45px;
        line-height: 68px;
    }

    .product-image {
        background-color: #cccccc;
        height: 400px;
        width: auto;
        background-position: center -50px;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }

    @media (max-width: 576px) {
        .main-header {
            height: calc(100vh - 220px);
            padding: 30px;
        }

        .header-text {
            position: absolute;
            top: 75%;
            color: white;
            text-transform: uppercase;
            width: 350px;
            text-align: center
        }

        .header-text h3 {
            font-weight: bolder;
            font-size: 25px;
            line-height: normal;
        }
    }

    @media (min-width: 320px) and (max-width: 576px) {
        .header-text h3 {
            font-weight: bolder;
            font-size: 20px;
            line-height: normal;
        }

        .header-text {
            position: absolute;
            top: 65%;
            color: white;
            text-transform: uppercase;
            width: auto;
            text-align: center;
        }
    }
</style>
@endsection

@section('content')
<div class="container-sm">
    <div class="main-header my-4">
        <div class="header-text">
            <h3>get your best wears for your best moments</h3>
            <button class="btn btn-dark px-3">SHOP NOW</button>
        </div>
    </div>
    <div class="section-1 py-5">
        <div class="text-center pb-5">
            <h4>NEW ARRIVALS</h4>
        </div>
        <div class="row justify-content-center">
            @foreach ($products as $product)
            <div class="col-md-3 mb-3">
                <a class=" text-decoration-none" href="{{ route('shop.product.show',$product->slug) }}">
                    <div class="card rounded-0 border-0">
                        <div class="product-image" style="background-image: url('{{ $product->images()->first()->url ?? '' }}')"></div>
                        <div class="card-body text-center text-decoration-none">
                            <h5 class="card-title text-uppercase  text-decoration-none">{{ $product->name }}</h5>
                            <p class="card-text "><span>£</span>{{ $product->price }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            <div class="col-4 text-center">
                <button class="btn btn-dark">VISIT STORE</button>
            </div>
        </div>
    </div>
</div>
<div class="p-5 mb-4 bg-light rounded-3 jumbotron">
    <div class="container-fluid col-md-4 offset-8 fs-6 py-3 mt-3 mb-5 bg-light bg-opacity-50">
        <h1 class="display-6 fw-bold">Custom jumbotron</h1>
        <p class="">Using a series of utilities, you can create this jumbotron, just like the one in
            previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your
            liking.</p>
    </div>
</div>
<div class="container py-5">
    <div class="row g-5">
        <div class="col-md-8">
            <div class="row g-3">
                <div class="col-md-6 bg-light">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
                <div class="col-md-6 bg-light">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
                <div class="col-md-12 bg-light">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-md-4 bg-light">
            <div class="right">
                {{-- <img src="{{ asset('images/pexels-gabriel-rodrigues-7050929.jpg') }}" class="img-fluid" alt=""> --}}
            </div>
        </div>
    </div>
</div>
@endsection
