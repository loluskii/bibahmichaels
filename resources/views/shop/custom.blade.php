@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row py-5">
        <div class="col-md-7 mx-auto">
            <h2 style="font-weight: 300">Custom Design Order</h2>
            <p>In addition to the designs offered in our collections, Bibah Michael also
                offers custom designs for any client that wants to bring their
                dream dress to life.</p>

                <p>If you are looking for a custom design, please fill out the form below.
                Our team will get back to you within 1-3 business days and guide
                you through the process. We will also provide a realistic estimate
                for the delivery date and cost.</p>

            <form action="{{ route('custom.store') }}" method="POST" class=" mt-5">
                @csrf
                
                @if ($message)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Success!</strong> {{ $message ?? '' }}.
                </div>
                @endif



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
                    <input type="text" name="occassion" id="" class="form-control form-control-lg" placeholder="" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Date of Event</label>
                    <input type="date" name="event_date" id="" class="form-control form-control-lg" placeholder="" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Dress Size/ Measurements</label>
                    <input type="text" name="measurements" id="" class="form-control form-control-lg" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Design image</label>
                  <input type="file" class="form-control" name="image" id="" placeholder="" aria-describedby="fileHelpId">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Order Request Ddescription</label>
                  <textarea class="form-control form-control-lg" name="order_desc" id="" rows="3"></textarea>
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Budget</label>
                  <select class="form-select form-select-lg rounded-0" name="budget" id="">
                    <option value="">Choose a budget</option>
                    <option value="cat_1">£700 - £1,000</option>
                    <option value="cat_2">£1,000 - £1,500</option>
                    <option value="cat_3">£1,500 - £2,000</option>
                    <option value="cat_4">Above £2,000</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-dark rounded-0 btn-block text-uppercase btn-block w-100">submit request</button>
            </form>
        </div>
    </div>
</div>
@endsection
