@extends('layouts.app')

@section('css')
<style>
    * {
        text-transform: none;
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





    .breadcrumb {
        justify-content: center;
    }

    .form-control::placeholder {
        color: #837C7C;
        opacity: 1;
        font-size: 15px;
        font-weight: 500px;
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

    .accordion-button::after {
        display: none;
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
                        <div class="header text-center">
                            <img src="{{ secure_asset('logo.svg') }}" class="img-fluid" style="height: 4em;" alt="">
                            <nav aria-label="breadcrumb" class="pb-4 text-center">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item " aria-current="page"><a
                                            class="text-decoration-none text-muted" href="#"><small>Cart</small></a>
                                    </li>
                                    <li class="breadcrumb-item active"><a class="text-decoration-none"
                                            href="#"><small>Information</small></a></li>
                                    <li class="breadcrumb-item text-muted"><small>Shipping</small></li>
                                    <li class="breadcrumb-item  text-muted"><small>Payment</small></li>
                                </ol>
                            </nav>
                        </div>
                        <div class="body py-3">
                            <div class="mb-4 d-sm-block d-md-none d-lg-none">
                                @include('partials.cart-accordion')
                            </div>
                            <div class="card mb-5">
                                <div class="card-body">
                                    <div class="contact d-flex justify-content-between align-items-center">
                                        <div class="row">
                                            <div class="col-auto">
                                                <span class="text-muted">Contact</span>
                                            </div>
                                            <div class="col-auto">
                                                <span class=" text-wrap">{{ $order->shipping_email }}</span>
                                            </div>
                                        </div>
                                        <a href="" class="text-decoration-none"><small
                                                style=" font-weight: 500">Change</small></a>
                                    </div>
                                    <hr style="width: auto">
                                    <div class="shipping d-flex justify-content-between align-items-center">
                                        <div class="row">
                                            <div class="col-auto">
                                                <span class="text-muted">Ships to</span>
                                            </div>
                                            <div class="col-auto">
                                                <span class="text-wrap">{{ $order->shipping_address }}, {{
                                                    $order->shipping_country }}</span>
                                            </div>
                                        </div>
                                        <a href="" class="text-decoration-none"><small
                                                style=" font-weight: 500">Change</small></a>
                                    </div>
                                </div>
                            </div>
                            <div class="shipping-information">
                                <h4 style="font-weight: normal">Payment</h4>
                                <p class="text-secondary">All payments are secure and encrypted. </p>
                                <form action="{{ route('checkout.page-3.store') }}" method="POST">
                                    @csrf
                                    <div class="accordion" id="accordionWithRadioExample">
                                        @php
                                            $currency = session('currency_code') ?? session('system_default_currency_info')->code;
                                        @endphp
                                        {{-- @if ($currency == "NGN")
                                            <div class="accordion-item">
                                                <div class="accordion-button">
                                                    <div class="custom-control custom-radio">
                                                        <input data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                            type="radio" id="customRadio1" value="paystack"
                                                            name="payment_method"
                                                            class="form-check-input custom-control-input" />
                                                        <label class="custom-control-label" for="customRadio1"> Pay with
                                                            <img src="{{ secure_asset('images/payment/paystack.svg')}}"
                                                                style=" height: 27px; " class="img-fluid" alt="">
                                                        </label>
                                                    </div>
                                                </div>
                                                <div id="collapseOne" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordionWithRadioExample">
                                                    <div class="card-body text-center px-5">
                                                        <img src="{{ secure_asset('images/payment/checkout.svg') }}"
                                                            class="img-fluid mb-3" alt="">
                                                        <p>After clicking “Complete order”, you will be redirected to
                                                            Paystack to complete your purchase securely.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif --}}
                                        <div class="accordion-item">
                                            <div class="accordion-button">
                                                <div class="custom-control custom-radio w-100">
                                                    <input data-bs-toggle="collapse" data-bs-target="#flutterwave"
                                                        type="radio" id="customRadio2" value="flutterwave"
                                                        name="payment_method"
                                                        class="form-check-input custom-control-input" />
                                                    <label class="custom-control-label w-75 " for="customRadio2">
                                                        Pay with Card
                                                        <img src="{{ secure_asset('images/payment/flutterwave.png')}}"
                                                            style=" height: 32px; " class="ms-5 img-fluid" alt="">
                                                    </label>
                                                </div>
                                            </div>
                                            <div id="flutterwave" class="collapse"
                                                data-bs-parent="#accordionWithRadioExample">
                                                <div class="card-body text-center px-5">
                                                    <img src="{{ secure_asset('images/payment/checkout.svg') }}"
                                                        class="img-fluid mb-3" alt="">
                                                    <p>After clicking “Complete order”, you will be redirected to
                                                        Flutterwave to complete your purchase securely.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <div class="accordion-button">
                                                <div class="custom-control custom-radio">
                                                    <input data-bs-toggle="collapse" data-bs-target="#stripe"
                                                        type="radio" id="customRadio2" value="stripe"
                                                        name="payment_method"
                                                        class="form-check-input custom-control-input" />
                                                    <label class="custom-control-label" for="customRadio2">Pay with Stripe
                                                        <img src="{{ secure_asset('images/payment/stripe.svg')}}"
                                                            style=" height: 20px; " class="img-fluid" alt="">
                                                    </label>
                                                </div>
                                            </div>
                                            <div id="stripe" class="collapse"
                                                data-bs-parent="#accordionWithRadioExample">
                                                <div class="card-body text-center px-5">
                                                    <img src="{{ secure_asset('images/payment/checkout.svg') }}"
                                                        class="img-fluid mb-3" alt="">
                                                    <p>After clicking “Complete order”, you will be redirected to Stripe
                                                        to complete your purchase securely.</p>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="accordion-item">
                                            <div class="accordion-button">
                                                <div class="custom-control custom-radio">
                                                    <input data-bs-toggle="collapse" data-bs-target="#paypal"
                                                        type="radio" id="customRadio2" value="paypal"
                                                        name="payment_method"
                                                        class="form-check-input custom-control-input" />
                                                    <label class="custom-control-label" for="customRadio2">
                                                        <img src="{{ secure_asset('images/payment/paypal.svg')}}"
                                                            style=" height: 25px; " class="img-fluid" alt="">
                                                    </label>
                                                </div>
                                            </div>
                                            <div id="paypal" class="collapse"
                                                data-bs-parent="#accordionWithRadioExample">
                                                <div class="card-body text-center px-5">
                                                    <img src="{{ secure_asset('images/payment/checkout.svg') }}"
                                                        class="img-fluid mb-3" alt="">
                                                    <p>After clicking “Complete order”, you will be redirected to Paypal
                                                        to complete your purchase securely.</p>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center pt-3">
                                        <a href="{{ route('checkout.page-2',$session) }}"
                                            class="text-decoration-none"><i class="fa fa-angle-left me-3"
                                                aria-hidden="true"></i> Return to shipping</a>
                                        <button type="submit"  class="btn btn-primary btn-dark py-3 px-3"
                                            style="font-weight: 400">Complete Order</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 bg-light  d-sm-none d-md-block border-start ps-4 pt-5 d-sm-block d-none">
            @include('partials.fullpage-cart_details')
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
