@extends('layouts.app')

@section('css')
<style>
    #button-addon1 {
        border-top: 1px solid #ced4da;
        border-left: 1px solid #ced4da;
        border-bottom: 1px solid #ced4da;
    }

    #button-addon2 {
        border-top: 1px solid #ced4da;
        border-right: 1px solid #ced4da;
        border-bottom: 1px solid #ced4da;
    }

    .image {
        background-color: #cccccc;
        height: 150px;
        width: 150px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }

    @media (max-width: 600px) {
        .image {
            width: 100%;
            height: 400px;
            background-position: center -40px;
        }
    }
</style>
@endsection
@section('content')
<div class="container my-5">
    <div class="row py-5 align-items-center">
        <div class="col-12 col-md-10 mx-auto ">
            @if ($cartItems->count() > 0)
            <h4 class="text-center mb-5">CART</h4>
            <div class="card-body p-4 my-5 border-top border-bottom">
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
                @foreach ($cartItems as $item)
                {{-- {{ $item }} --}}
                <div class="row d-flex justify-content-between align-items-center mb-5">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                        <div class="image"
                            style="background-image: url('{{ secure_asset('products/'.$item->associatedModel->slug                                       .'/'.$item->associatedModel->images()->first()->url) }}')">
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                        <p class="lead text-uppercase fw-bold mb-2">{{ $item->name }}</p>
                        <p>
                            @foreach ($item->attributes as $key => $value)
                            <span class="text-muted text-capitalize">{{ $key }}: {{ $value }}</span>
                            @endforeach
                        </p>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                        <form action="{{route('cart.update', $item->id)}}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <button class="btn px-2 btn-sm rounded-0 minus fw-bold" style="color: #bbb"
                                    type="button" id="button-addon1">-</button>
                                <input type="text" value="{{ $item->quantity }}" name="quantity"
                                    onchange="this.form.submit()" readonly
                                    class="bg-white form-control text-center border-start-0 border-end-0"
                                    aria-label="Amount (to the nearest dollar)">
                                <button class="btn btn-sm px-2 plus rounded-0 fw-bold" style="color: #bbb" type="button"
                                    id="button-addon2">+</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                        <h5 class="mb-0">{{ $currency_symbol }}{{
                            number_format(App\Helpers\Helper::currency_converter($item->price), 2) }}</h5>
                    </div>
                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                        <a href="{{ route('cart.destroy', $item->id) }}" class=""><i class="fas fa-trash fa-lg"></i></a>
                    </div>
                </div>
                @endforeach

            </div>
            <div
                class="d-flex justify-content-between align-items-baseline px-4 {{ ($cartItems->count() < 1) ? 'd-none' : '' }}">
                <div class="mb-3">
                    <label for="" class="form-label">Add Order Note</label>
                    <textarea class="form-control" style="resize: none" name="" id="" rows="3" cols="30"></textarea>
                </div>
                <div class="text-end">
                    <h3> </h3>

                    <h6 class="text-capitalize">total: {{ $currency_symbol }}{{
                        number_format(App\Helpers\Helper::currency_converter(Cart::session(App\Helpers\Helper::getSessionID())->getSubTotal())
                        , 2) }} </h6>
                    <p>Shipping & taxes calculated at checkout </p>
                    <a href="{{ route('checkout.page-1',session()->get('session')) }}"
                        class="btn btn-dark rounded-0">CHECKOUT</a>
                </div>
            </div>
            @else
            <div class="text-center">
                <h6> YOUR CART IS EMPTY </h6>
                <a href="{{ route('shop') }}" class="btn btn-dark rounded-0">VISIT OUR SHOP</a>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
    $(document).ready(function (){
        $('.minus').click(function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();
            return false;
        });
        $('.plus').click(function () {
            var $input = $(this).parent().find('input');
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            return false;
        });
    })
</script>
@endsection
