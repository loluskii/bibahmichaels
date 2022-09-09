
@extends('layouts.app')

@section('title')
Reset Password | Bibah Michael
@endsection

@section('css')
<style>
    .card {
        margin-top: 100px;
        margin-bottom: 100px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 mx-auto">
            <div class="card border-0">
                <div class="card-body">
                    <div class="head text-center">
                        <h3>CREATE A NEW PASSWORD</h3>
                        <p>Please enter your new password to begin</p>
                    </div>
                    <form method="POST" action="{{ route('user.password.update') }}" autocomplete="off">
                        @csrf
                        {{-- @if (session('loginMsg'))
                        <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
                            {{ session('loginMsg') }}
                        </div>
                        @endif --}}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="mb-2">
                            <label for="" class="form-label"></label>
                            <input type="email" name="email" id="" class="form-control @error('email') is-invalid @enderror form-control-lg" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Email" aria-describedby="helpId">
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="mb-2">
                            <label for="" class="form-label"></label>
                            <input type="password" name="password" id="" class="form-control @error('password') is-invalid @enderror form-control-lg" placeholder="Password" aria-describedby="helpId">
                        </div>
                        @error('password')
                            <b class="text-danger">{{ $message }} </b>
                        @enderror

                        <div class="mb-2">
                            <label for="" class="form-label"></label>
                            <input type="password" name="password_confirmation" id="" class="form-control @error('password_confirmation') is-invalid @enderror form-control-lg" placeholder="Confirm Password" aria-describedby="helpId">
                        </div>
                        @error('password_confirmation')
                            <b class="text-danger">{{ $message }} </b>
                        @enderror


                        <div class="d-grid gap-2">
                            <button type="submit" name="" id=""
                                class="rounded-0 btn btn-dark text-uppercase">Submit</button>
                        </div>

                    </form>
                    <p class="text-muted text-center mt-3">Already have an account? <a href="{{ route('login') }}" class="text-decoration-none">Go Back</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

