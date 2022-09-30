@extends('layouts.app')


@section('css')
<style>
    .main-header {
        background-image: url("{{ secure_asset('images/coming-soon-bm.jpeg') }}");
        background-color: #cccccc;
        height: 100vh;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        /* padding: 60px; */
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
<div class="container container-md container-lg">
    <div class="main-header">
        {{-- <div class="header-text">
            <h3>get your best wears for your best moments</h3>
            <button class="btn btn-dark px-3">SHOP NOW</button>
        </div> --}}
    </div>
</div>
@endsection
