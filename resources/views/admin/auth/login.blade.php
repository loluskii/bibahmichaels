@extends('admin.layout.login-layout')

@section('content')
<div class="auth-box">
    <div class="top">
        <img src="https://www.wrraptheme.com/templates/lucid/html/assets/images/logo-white.svg" alt="Lucid">
    </div>
    <div class="card">
        <div class="header">
            <p class="lead">Login to your account</p>
        </div>
        <div class="body">
            <form class="row g-3 needs-validation" autocomplete="off" method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="col-12">
                    <div class="form-group">
                        <div class="input-group has-validation">
                            <input name="email" type="email" placeholder="Email" class="form-control" value="{{ old('email') }}" required
                                autocomplete="email" autofocus>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <input id="password" type="password" placeholder="Password" class="form-control" name="password" required
                        autocomplete="current-password">
                    </div>
                </div>
                {{-- <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember')
                            ? 'checked' : '' }}>
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                </div> --}}
                <div class="col">
                    <div class="form-group clearfix">
                        <label class="fancy-checkbox element-left">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>Remember me</span>
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-dark btn-lg w-100" type="submit">Login</button>
                </div>
                @if (Route::has('password.request'))
                <div class="col-12 d-none">
                    <p class="small mb-0"> <a href="">Forgot
                            password</a></p>
                </div>
                @endif
            </form>
        </div>
    </div>
</div>

@endsection
