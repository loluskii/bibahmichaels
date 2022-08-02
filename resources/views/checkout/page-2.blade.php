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

    .form-control{
        border-radius: 0.3rem;
    }

    h5{
        font-weight: 400;
    }

    span.badge {
        top: -5px;
        right: 10px;
        /* bottom: 10px; */
        transition: all .3s ease-in-out;
    }



    .breadcrumb{
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
</style>
@endsection

@section('content')
<div class="container-fluid ">
    <div class="row min-vh-100">
        <div class="col-md-7 border-end">
            <div class="checkout-main">
                <div class="col-md-1"></div>
                <div class="col-md-11 col-12">
                    <div class="main ps-0 ms-0 ps-md-5 ms-md-5 ps-lg-5">
                        <div class="header text-center">
                            <img src="{{ asset('logo.svg') }}" class="img-fluid" style="height: 4em;" alt="">
                            <nav aria-label="breadcrumb" class="pb-4 text-center">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item " aria-current="page"><a class="text-decoration-none text-muted" href="#"><small>Cart</small></a></li>
                                    <li class="breadcrumb-item"><a class="text-decoration-none text-muted"  href="#"><small>Information</small></a></li>
                                    <li class="breadcrumb-item active text-dark"><small>Shipping</small></li>
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
                                                <span
                                                    class=" text-wrap">{{ $order->shipping_email }}</span>
                                            </div>
                                        </div>
                                        <a href="" class="text-decoration-none"><small style=" font-weight: 500">Change</small></a>
                                    </div>
                                    <hr style="width: auto">
                                    <div class="shipping d-flex justify-content-between align-items-center">
                                        <div class="row">
                                            <div class="col-auto">
                                                <span class="text-muted">Ships to</span>
                                            </div>
                                            <div class="col-auto">
                                                <span
                                                    class="text-wrap">{{ $order->shipping_address }}</span>
                                            </div>
                                        </div>
                                        <a href="" class="text-decoration-none"><small style=" font-weight: 500">Change</small></a>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('checkout.page-2.store') }}" method="POST" class="pb-5">
                                @csrf
                                <input type="hidden" name="subtotal" value="{{ \Cart::session(auth()->check() ? auth()->id() : 'guest')->getSubTotal() }}">
                                <input type="hidden" name="grand_total" value="{{ \Cart::session(auth()->check() ? auth()->id() : 'guest')->getTotal() }}">

                                <div class="shipping-information">
                                    <h4 style="font-weight: normal" class="mb-4">Shipping Method</h4>

                                    <label class="card p-3 checkbox-label d-flex w-100" id="planbox">
                                        <div class="d-flex align-items-center justify-content-between">
                                            {{-- <div class="d-flex align-items-center">
                                                <input type="radio" class="form-check-input" class="me-4" checked
                                                    value="{{ 0 }}" name="shipping">

                                                <h5 class="h6 text-muted">Standard Shipping</h5>
                                            </div> --}}
                                            <div class="form-check">
                                                <input class="form-check-input me-3" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                                <label class="form-check-label" for="exampleRadios1">
                                                    <h6 class="mb-0">Standard Shipping</h6>
                                                    <small class="mb-0 text-muted">
                                                        7 - 21 business days
                                                    </small>
                                                </label>
                                            </div>
                                            <span>${{ $conditionValue }}</span>
                                        </div>
                                    </label>
                                </div>

                                <div class="d-flex justify-content-between align-items-center pt-3">
                                    <a href="{{ route('checkout.page-1',$session) }}" class="text-decoration-none"><i class="fa fa-angle-left me-3" aria-hidden="true"></i> Return to information</a>
                                    <button type="submit" class="btn btn-primary btn-dark py-3 px-3" style="font-weight: 400">Continue to
                                        Payment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 bg-light  d-sm-none d-md-block border-start ps-4 pt-5 d-sm-block d-none">
            <div class="checkout-main">
                <div class=" pe-0 me-0 pe-md-5 me-md-5 pe-lg-5">
                    <div class="product border-bottom">
                        <table class="table table-borderless">
                            <tbody>
                                @foreach ($cartItems as $item)
                                <tr class="d-flex align-items-center">
                                    <td scope="row" style="width: 20%; position: relative; height: 64px; width: 64px">
                                        <img class="img-fluid img-thumbnail" style=""
                                            src="{{ asset('images/pexels-gabriel-rodrigues-7050929.jpg') }}" alt="">

                                            <span class="position-absolute badge bg-dark border border-light rounded-circle" style="">{{ $item->quantity }}</span>

                                    </td>
                                    <td style="width: 60%;">
                                        <span
                                            class="product__description__variant order-summary__small-text text-uppercase"
                                            style="display: block;">{{ $item->name }}</span>
                                    </td>
                                    <td style="width: 20%; justify-content: end">
                                        <div class="float-end">
                                            <span class="currency">£</span>{{ number_format($item->price, 2) }}
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
                            <span><span class="currency">£</span>{{ number_format(Cart::session(auth()->check() ? auth()->id() : 'guest')->getSubTotal(), 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p>Shipping</p>
                            <p><small class="text-muted">Calculated at the next step</small></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-4">
                        <h5>Total</h5>
                        <h3>${{ number_format(Cart::session(auth()->check() ? auth()->id() : 'guest')->getTotal(), 2) }} </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection






