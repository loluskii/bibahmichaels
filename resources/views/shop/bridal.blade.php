@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row py-5">
        <div class="col-md-7 mx-auto">
            <h2 style="font-weight: 300">Custom Design Order</h2>
            <p>Please complete the form below to place your order. We aim to respond to your requests within 24-48 hours, after which we provide a realistic estimate for delivery date and cost.</p>

            <form action="{{ route('store.bridal') }}" class=" mt-5">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">First Name</label>
                            <input type="text" name="fname" id="" class="form-control form-control-lg" placeholder="" aria-describedby="helpId">
                          </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Last Name</label>
                            <input type="text" name="lname" id="" class="form-control form-control-lg" placeholder="" aria-describedby="helpId">
                          </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="text" name="email" id="" class="form-control form-control-lg" placeholder="" aria-describedby="helpId">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Occassion</label>
                    <input type="text" name="phone_no" id="" class="form-control form-control-lg" placeholder="" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Date of Event</label>
                    <input type="date" name="event_date" id="" class="form-control form-control-lg" placeholder="" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Dress Size/ Measurements</label>
                    <input type="text" name="measurements" id="" class="form-control form-control-lg" placeholder="" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Your Country</label>
                    <select class="form-select form-select-lg" name="country" id="">
                      <option>New Delhi</option>
                      <option>Istanbul</option>
                      <option>Jakarta</option>
                    </select>
                  </div>
                <div class="mb-3">
                  <label for="" class="form-label">Order Request Ddescription</label>
                  <textarea class="form-control form-control-lg" name="order_desc" id="" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-dark rounded-0 btn-block text-uppercase btn-block w-100">submit request</button>
            </form>
        </div>
    </div>
</div>
@endsection
