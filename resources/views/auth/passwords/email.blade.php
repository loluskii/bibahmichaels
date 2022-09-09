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
                        <h3>FORGOT PASSWORD</h3>
                        <p>Please enter your email address to receive a reset link</p>
                    </div>
                    <form method="POST" action="{{ route('user.reset.password') }}" autocomplete="off">
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
