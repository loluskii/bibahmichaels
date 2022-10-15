@extends('layouts.app')

@section('css')
<style>
    * {
        text-transform: none;
        font-weight: normal;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"
    }

    .checkout-main {
        padding: 40px;

    }

    .form-control {
        border-radius: 0.3rem;
    }

    h5 {
        font-weight: 400;
    }

    span.badge {
        top: -5px;
        right: 10px;
        /* bottom: 10px; */
        transition: all .3s ease-in-out;
    }



    .breadcrumb {
        justify-content: center;
    }

    .form-control::placeholder {
        color: #837C7C;
        opacity: 1;
        font-size: 15px;
        font-weight: 400;
    }

    .product__description__variant {
        font-size: 13px;
    }

    @media only screen and (max-width: 595px) {
        .checkout-main {
            padding: 10px;
        }

        .wrapper {
            padding-left: 0px;
            padding-right: 0px;
            margin-left: 0px;
            margin-right: 0px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-7 border-end">
            <div class="checkout-main">
                <div class="col-md-1"></div>
                <div class="col-md-11 col-12">
                    <div class="main ps-0 ms-0 ps-md-5 ms-md-5 ps-lg-5">
                        <div class="header text-start position-relative ">
                            <img src="{{ secure_asset('2.png') }}" class="d-md-block d-lg-block d-none img-fluid position-relative"
                                style="right: 5%; height: 6em;" alt="">
                        </div>
                        <div class="body px-sm-4 px-0 ms-sm-3 ms-0 mt-4 ps-sm-3 ps-0">
                            <div class="top position-relative">
                                <i class="fa-regular fa-3x fa-circle-check position-absolute end-100 me-3"
                                    style="top: 12%"></i>
                                <p class="mb-2">Order #{{ $order->order_reference }}</p>
                                <h4>Thank you, Lolu!</h4>
                            </div>

                            <div class="box-1 mt-5 mb-3 p-3 border rounded-2">
                                <h5>Your order is confirmed</h5>
                                <p class="mb-0">We’ve accepted your order, and we’re getting it ready. Come back to this
                                    page for updates on your shipment status.</p>
                            </div>
                            <div class="box-1 mb-3 p-3 border rounded-2">
                                <h5>Order Updates</h5>
                                <p class="mb-0">You’ll get shipping and delivery updates by email.</p>
                            </div>
                            <div class="box-1 mb-3 p-3 border rounded-2">
                                <h5 class="mb-4">Customer Information</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Contact information</h6>
                                        <p>{{ $order->shipping_email }}</p>
                                        <h6>Shipping Address</h6>
                                        <p class="mb-0">{{ $order->shipping_fname }} {{ $order->shipping_lname }}</p>
                                        <p class="mb-0">{{ $order->shipping_address }}, {{ $order->shipping_postal_code }} {{ $order->shipping_state }}, {{ $order->shipping_country }}</p>
                                        <p>{{ $order->shipping_phone }}</p>

                                    </div>
                                    <div class="col-6">
                                        <h6>Payment Method</h6>
                                        <p>{{ $order->payment_method }} - {{ $order->order_currency }} {{ number_format($order->grand_total, 2) }}</p>
                                        <h6>Shipping Method</h6>
                                        <p>Standard Shipping</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-content-center mt-2">
                                <div class="col-6">
                                    <p class="mb-0">Need help? <a href="{{ route('contact') }}">Contact Us</a></p>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('shop') }}" class="btn btn-dark p-3 float-end">Continue Shopping</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 bg-light  d-sm-none d-md-block border-start ps-4 pt-5 d-sm-block d-none">
            <style>
                span.badge {
                    top: -5px;
                    right: 10px;
                    /* bottom: 10px; */
                    transition: all .3s ease-in-out;
                }
            </style>

            <div class="checkout-main">
                <div class=" pe-0 me-0 pe-md-5 me-md-5 pe-lg-5">
                    <div class="product border-bottom">
                        <table class="table table-borderless">
                            <tbody>
                                @foreach ($order->items as $item)
                                {{-- {{ $item }} --}}
                                <tr class="d-flex align-items-center">
                                    <td scope="row" style="width: 20%; position: relative;">
                                        <div>
                                            <img class="img-fluid img-thumbnail"
                                                style=" height: 64px; width: 64px; object-fit: contain;"
                                                src="{{ $item->images()->first()->url ?? '' }}"
                                                alt="">
                                        </div>

                                        <span class="position-absolute badge bg-dark border border-light rounded-circle"
                                            style="">{{
                                            $item->pivot->quantity }}</span>

                                    </td>
                                    <td style="width: 60%;">
                                        <span
                                            class="product__description__variant order-summary__small-text text-uppercase"
                                            style="display: block;">{{ $item->name }}</span>
                                    </td>

                                    <td style="width: 30%; justify-content: end">
                                        <div class="float-end">
                                            {{ $currency->symbol }}{{ number_format($item->pivot->price, 2) }}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="price border-bottom">
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2">
                            <span>Subtotal</span>
                            <span>{{ $currency->symbol }}{{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            @php
                                $shipping = $order->grand_total - $order->subtotal;
                            @endphp
                            <p>Shipping</p>
                            <p><small class="text-muted">{{ $currency->symbol }}{{ number_format($shipping, 2) }}</small></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-4">
                        <h5>Total</h5>
                        <h3><small class="">{{ $currency->symbol }}</small>{{ number_format($order->grand_total, 2) }} {{ $order->order_currency }}</h3>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
