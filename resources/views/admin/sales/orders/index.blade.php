@extends('admin.layout.app')

@section('title')
    Orders
@endsection



@section('content')
<div class="row clearfix w-100">
    <div class="col-lg-3 col-md-6">
        <div class="card overflowhidden">
            <div class="body">
                <h3>{{ $orders->count() }} <i class="icon-briefcase float-right"></i></h3>
                <span>Total Orders</span>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card overflowhidden">
            <div class="body">
                <h3>{{ $pending->count() }}<i class="icon-clock float-right"></i></h3>
                <span>Pending Orders</span>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix w-100">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <h2>All Orders</h2>

            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width:60px;">#</th>
                                <th>Order ID</th>
                                <th>Email</th>
                                <th>Payment Method</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>#23mf034-2323</td>
                                <td>test@email.com</td>
                                <td>Paystack</td>
                                <td>£60.00</td>
                                <td><span class="badge badge-success">shipping in progress</span></td>
                                <td><button class="btn btn-info btn-sm">View</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
