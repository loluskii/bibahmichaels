@extends('layouts.app')
@section('styles')
<style>
    #about-us p,
    #about-us h6, p span {
        font-size: 14px;
        line-height: 20px;
        text-transform: none;
    }
</style>
@endsection
@section('content')
<div class="container pt-3 pb-5" id="about-us" style="min-height: 75vh">

    <div class="row">
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
        <div class="col-md-4 col-lg-4 col-sm-12 border-end">
            <a href="{{ route('user') }}" class="btn mb-3"> <i class="bi bi-arrow-left"></i> Back</a>
            <section class="py-3 px-3 mb-5">
                <p class="text-start mb-0">ORDER {{ $order->order_number }}</p>
                <small style="font-size: 12px" class="mb-0">{{ $order->created_at->diffForHumans() }} | <span
                        class="badge {{ $color ?? 'bg-secondary' }}">{{ $status }}</span></small>
            </section>

            {{-- <button type="button" name="" id="" class="px-3 py-2 btn btn-dark fw-bold"></button> --}}


        </div>
        <div class="col-md-8 col-lg-8 col-sm-12">
            <section class="py-3 px-3">
                <h6 class="text-start ">Order Details</h6>
                <p class="mb-0">{{ $order->item_count }} Item(s) | Total: {{ $order->order_currency }} {{ number_format($order->grand_total, 2) }}</p>
                <p></p>
            </section>
            <section class="py-3 px-3">
                <h6 class="text-start  text-uppercase">Items in your order</h6>
                @foreach ($order->items as $item)
                    <div class="card border-0 my-3">
                        <div class="row g-0">
                            <div class="col-md-3 col-lg-4 col-6 text-start">
                                <img src="{{ $item->images()->first()->url ?? '' }}" style="height: 120px; width: 200px; object-fit: contain" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-9 col-lg-4 col-6">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->name }}</h5>
                                    <p>QTY: {{ $item->pivot->quantity }}</p>
                                    <h5>${{ number_format($item->price,2) }}</h5>
                                    {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>

            <section class="px-3">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="card border-0 h-100">
                            <div class="card-header border-0 bg-light">
                                Payment Information
                            </div>
                            <div class="card-body  border-0">
                                <div>
                                    <h6 class="card-title">Payment Details</h6>
                                    <p class="mb-0 card-text"><span class="text-muted">Items Total:</span>{{ $order->order_currency }} {{ number_format($order->subtotal,2) }}</p>
                                    {{-- <p class="mb-0 card-text"><span class="text-muted">Shipping Fees:</span> </p> --}}
                                    <p class="mb-0 card-text"><span class="text-muted">Grand Total:</span> {{ $order->order_currency }} {{ number_format($order->grand_total,2) }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="card border-0 h-100">
                            <div class="card-header border-0 bg-light">
                                Delivery Information
                            </div>
                            <div class="card-body  border-0">
                                <div class="mb-3">
                                    <h6 class="card-title mb-0">Delivery Method</h6>
                                    <p class="card-text text-muted">Standard Door Delivery</p>
                                </div>
                                <div>
                                    <h6 class="card-title">Shipping Details</h6>
                                    <p class="mb-0 card-text"><span class="text-muted">{{ $order->shipping_fname }} {{ $order->shipping_lname }}</span> </p>
                                    <p class="mb-0 card-text"><span class="text-muted">{{ $order->shipping_address }}, {{ $order->shipping_city }} {{ $order->shipping_state }} {{ $order->shipping_country }}</span> </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
@endsection
