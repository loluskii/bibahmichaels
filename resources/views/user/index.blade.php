@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row my-5">
        <div class="col">
            <div class="mb-4">
                <a class="text-muted fw-bold" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    LOGOUT
                </a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <h4>MY ACCOUNT</h4>
            <p>Welcome back, {{ Auth::user()->fname }}.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card border-0">
                <h6 class="card-title py-2 border-bottom">MY ORDERS</h6>
                <div class="card-body px-0">
                    @if ($orders->count() < 1)
                        <p>You haven't placed any orders yet</p>
                    @else

                    @endif
                    {{-- <p crlass="card-text">Text</p> --}}
                </div>
            </div>
        </div>
        <div class="col-1"></div>
        <div class="col-md-4">
            <div class="card border-0">
                <h6 class="card-title py-2 border-bottom">ADDRESS</h6>
                <div class="card-body px-0">
                    <p class="card-text">{{ $default->shipping_fname }} {{ $default->shipping_fname }}</p>
                    <p class="mb-0">{{ $default->shipping_address }}</p>
                    <p class="mb-0">{{ $default->shipping_zipcode }}, {{ $default->shipping_city }}</p>
                    <p>{{ $default->shipping_state }}, {{ $default->shipping_country }}</p>
                </div>
            </div>
            <a href="" class="btn btn-dark text-uppercase rounded-0 ">Edit Addresss</a>
        </div>
    </div>
</div>
@endsection
