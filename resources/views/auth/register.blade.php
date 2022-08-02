

@extends('layouts.app')

@section('title')
Register | Bibah Michael
@endsection

@section('css')
<style>
    .card {
        margin-top: 80px;
        margin-bottom: 80px;
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
                        <h3>Register</h3>
                        <p>Please enter your credentials to create your account</p>
                    </div>
                    <form method="POST" action="{{ route('register') }}" autocomplete="off">
                        @csrf
                        @error('email')
                            <div class="alert alert-danger mb-1 py-2 rounded-0" role="alert">
                                <p class="mb-0">{{ $message }}</p>
                            </div>
                        @enderror
                        @error('password')
                        <div class="alert alert-danger mb-1 py-2 rounded-0" role="alert">
                            <p class="mb-0">{{ $message }}</p>
                        </div>
                        @enderror

                        <div class="mb-2">
                            <label for="" class="form-label"></label>
                            <input type="text" required name="fname" id=""
                                class="form-control form-control-lg"
                                placeholder="Last Name" aria-describedby="helpId">
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label"></label>
                            <input type="text" required name="lname" id=""
                                class="form-control form-control-lg"
                                placeholder="Last Name" aria-describedby="helpId">
                        </div>

                        <div class="mb-2">
                            <label for="" class="form-label"></label>
                            <input type="text" required name="email" id=""
                                class="form-control form-control-lg"
                                placeholder="Email" aria-describedby="helpId">
                        </div>
                        <div class="mb-4">
                            <label for="" class="form-label"></label>
                            <input type="password" required name="password" id=""
                                class="form-control form-control-lg"
                                placeholder="Password" aria-describedby="helpId">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" name="" id=""
                                class="rounded-0 btn btn-dark text-uppercase">create my account</button>
                        </div>
                    </form>
                    <p class="text-muted text-center mt-3">Already have an account? <a href="{{ route('login') }}" class="text-decoration-none">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
