@extends('layouts.app')


@section('css')
<style>
    body{
        background-color: #fff
    }
    .main-header {
        background-image: url("{{ secure_asset('images/will-be back.svg') }}");
        background-color: #cccccc;
        height: 500px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        /* padding: 60px; */
    }

    .main-heade{
        height: 100vh;
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

        .product-image {
            background-position: center 1px;
            height: 250px;
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
            top: 70%;
            color: white;
            text-transform: uppercase;
            width: auto;
            text-align: center;
        }
    }
</style>
@endsection

@section('content')
<div class="container p-0 container-md container-lg">
    <div class="main-heade">
        <div class="row h-100">
            <div class="col-6 text-center mx-auto my-auto">
                <img src="{{ secure_asset('images/will-be-back.png') }}" alt="" srcset="">
            </div>
        </div>
        {{-- <div class="header-text">
            <h3>get your best wears for your best moments</h3>
            <button class="btn btn-dark px-3">SHOP NOW</button>
        </div> --}}
    </div>
</div>
@endsection
