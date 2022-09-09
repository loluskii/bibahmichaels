@extends('layouts.app')

@section('title')
Login | Bibah Michael
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
                        <h3>LOGIN</h3>
                        <p>Please enter your credentials to login</p>
                    </div>
                    <form method="POST" action="{{ route('auth.login') }}" autocomplete="off">
                        @csrf
                        @if (session('loginMsg'))
                        <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
                            {{ session('loginMsg') }}
                        </div>
                        @endif
                        <div class="mb-2">
                            <label for="" class="form-label"></label>
                            <input type="text" name="email" id=""
                                class="form-control form-control-lg"
                                placeholder="Email" aria-describedby="helpId">
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label"></label>
                            <input type="password" name="password" id=""
                                class="form-control form-control-lg"
                                placeholder="Password" aria-describedby="helpId">
                        </div>

                        <div class="row justify-content-between align-items-center mb-3">
                            <div class="col text-start">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{
                                        old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label fw-light" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col text-end">
                                <a class="text-decoration-none fw-light" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" name="" id=""
                                class="rounded-0 btn btn-dark text-uppercase">Login</button>
                        </div>
                    </form>
                    <p class="text-muted text-center mt-3">Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none">Create one</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
