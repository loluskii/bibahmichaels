
@extends('admin.layout.app')

@section('title')
    Currency Settings
@endsection



@section('content')
<div class="row clearfix w-100">
    <div class="col-lg-3 col-md-6">
        <div class="card overflowhidden">
            <div class="body">
                <h3>{{ $currencies->count() }} <i class="icon-briefcase float-right"></i></h3>
                <span>Total Currencies</span>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix w-100">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header d-flex justify-content-between">
                <h2>All Currencies</h2>
                <button data-toggle="modal" data-target="#newCurrency" class="btn btn-secondary btn-sm">New Currency</button>
                @include('admin.settings.currency.create')
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Exchange Rate</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($currencies as $key => $currency)

                            <tr>
                                <td>{{ ++$key }}</td>
                                <td class="text-uppercase">{{ $currency->name }}</td>
                                <td>{{ $currency->code }}</td>
                                <td>{{ $currency->exchange_rate }}</td>
                                <td>
                                    @include('admin.settings.currency.edit')
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
