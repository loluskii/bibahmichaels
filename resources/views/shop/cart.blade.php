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

    .image{
        background-color: #cccccc;
        height: 150px;
        width: 150px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }

    @media (max-width: 600px){
        .image{
            width: 100%;
            height: 400px;
            background-position: center -40px;
        }
    }
</style>
@endsection
@section('content')
<div class="container my-5">
    <div class="row py-5">
        <div class="col-12 col-md-10 mx-auto">
            <h4 class="text-center mb-5">CART</h4>
            <div class="card-body p-4 my-5 border-top border-bottom">
                @foreach ($cartItems as $item)
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                        <div class="image" style="background-image: url('{{ $item->associatedModel->images()->first()->url }}')">
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                        <p class="lead text-uppercase fw-bold mb-2">{{ $item->name }}</p>
                        <p><span class="text-muted">Size: </span>M <span class="text-muted">Color: </span>Grey</p>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                        <div class="input-group mb-3">
                            <button class="btn px-2 btn-sm rounded-0 minus fw-bold" style="color: #bbb" type="button"
                                id="button-addon1">-</button>
                            <input type="text" value="1" name="quantity" readonly
                                class="bg-white form-control text-center border-start-0 border-end-0"
                                aria-label="Amount (to the nearest dollar)">
                            <button class="btn btn-sm px-2 plus rounded-0 fw-bold" style="color: #bbb" type="button"
                                id="button-addon2">+</button>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                        <h5 class="mb-0">£{{ 0 }}</h5>
                    </div>
                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                        <a href="#!" class=""><i class="fas fa-trash fa-lg"></i></a>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="d-flex justify-content-between align-items-baseline px-4">
                <div class="mb-3">
                    <label for="" class="form-label">Add Order Note</label>
                    <textarea class="form-control" style="resize: none" name="" id="" rows="3" cols="30"></textarea>
                </div>
                <div class="text-end">
                    <h6 class="text-capitalize">total: </h6>
                    <p>Shipping & taxes calculated at checkout </p>
                    <button class="btn btn-dark rounded-0">CHECKOUT</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
