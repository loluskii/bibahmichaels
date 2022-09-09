@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row my-5">
        <div class="col">
            <div class="mb-4">
                <a href="" class="text-muted fw-bold text-decoration-none"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    LOGOUT
                </a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <h4>MY ACCOUNT</h4>
            <p>Welcome back, {{ Auth::user()->fname }}.</p>
            {{-- {{ auth()->user()->hasVerifiedEmail() ? 'true' : 'false' }} --}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card border-0">
                <h6 class="card-title py-2 border-bottom">MY ORDERS</h6>
                <div class="card-body px-0">
                    @if ($orders->count() < 1) <p>You haven't placed any orders yet</p>
                        @else
                        @foreach ($orders as $order)
                        @php
                        if($order->status == 1){
                        $status = 'Pending';
                        }elseif ($order->status == 2) {
                        $color = 'bg-warning';
                        $status = 'Awaiting Pickup';
                        }elseif ($order->status == 3) {
                        $color = 'bg-info';
                        $status = 'Shipping in Progress';
                        }elseif ($order->status == 4) {
                        $color = 'bg-success';
                        $status = 'Shipped';
                        }elseif ($order->status == 5) {
                        $color = 'bg-danger';
                        $status = 'Cancelled';
                        }else {
                        $status = 'Unknown';
                        }
                        @endphp
                        <div class="py-2 border-top-0 border-left-0 border-right-0 rounded-0 border-bottom mb-3">
                            <div class="card-body px-1 px-lg-2 px-md-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <div
                                            class="col-md-1 ms-3 me-4 col-lg-1 col-sm-1 d-flex align-items-center justify-content-center">
                                            <i class="bi bi-box text-dark" style="font-size: 25px"></i>
                                        </div>
                                        <div class="col-md-11 col-lg-11 col-sm-11">
                                            <p class="mb-0">Order {{ $order->order_number }}</p>
                                                <small style="font-size: 10px">{{ $order->created_at->diffForHumans() }} | <span class="badge {{ $color ?? 'bg-secondary' }}">{{ $status}}</span></small>
                                        </div>
                                    </div>
                                    <a href="{{ route('user.order.show', $order->order_reference) }}"
                                        class="btn btn-dark btn-sm rounded-0"> <span class="d-lg-none d-md-none d-xl-none"><i
                                                class="bi bi-eye-fill" style="color: white"></i></span> <span
                                            style="color: white" class="d-none d-lg-block d-md-block d-xl-block">View
                                            Details</span></a>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        @endif
                        {{-- <p crlass="card-text">Text</p> --}}
                </div>
            </div>
        </div>
        <div class="col-1"></div>
        <div class="col-md-4">
            <div class="card border-0">
                <h6 class="card-title py-2 border-bottom">ADDRESS</h6>
                <div class="card-body px-0 {{ $default->shipping_fname ?? 'd-none' }} ">
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
