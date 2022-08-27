
@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center my-5">
            <h4>VERIFY YOUR EMAIL</h4>
            <p>Please check your email for a verification link. If you didn't get it please clcik the button below to resend.</p>
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-dark btn-lg rounded-0">RESEND</button>.
            </form>
        </div>
    </div>
</div>
@endsection

