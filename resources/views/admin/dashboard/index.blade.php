@extends('admin.layout.app')

@section('title')
    Dashboard
@endsection



@section('content')
<div class="row clearfix w-100">
    <div class="col-lg-3 col-md-6">
        <div class="card overflowhidden">
            <div class="body">
                <h3>{{ $products }} <i class="icon-briefcase float-right"></i></h3>
                <span>Total Products</span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card overflowhidden">
            <div class="body">
                <h3>{{ $sales }} <i class="fa fa-money float-right"></i></h3>
                <span>Total Sales</span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card overflowhidden">
            <div class="body">
                <h3>{{ $orders }} <i class="icon-clock float-right"></i></h3>
                <span>Total Orders</span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card overflowhidden">
            <div class="body">
                <h3>{{ $users }} <i class=" icon-users float-right"></i></h3>
                <span>Total Customers</span>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix w-100">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Annual Report</h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <span class="text-muted">Monthly Report</span>
                        <h3 class="text-warning">$4,516</h3>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <span class="text-muted">Annual Report </span>
                        <h3 class="text-info">$6,481</h3>
                    </div>
                </div>
                <div id="area_char" class="graph"></div>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix w-100">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Recent Orders</h2>

            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-striped">
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
                            @if ($recent_orders->count() > 0)
                                @foreach ($recent_orders as $order)
                                <tr>
                                    <td>{{ $loop->index }}</td>
                                    <td>{{ $order->order_reference }}</td>
                                    <td>{{ $order->shipping_email }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>{{ $order->grand_total }}</td>
                                    <td><span class="badge badge-success">{{ $order->status }}</span></td>
                                    <td><a  href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">View</a></td>
                                </tr>
                                @endforeach
                            @else
                                <tr class="text-center" >
                                    <td colspan="7">No Recent Orders</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix w-100">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Recent Customers</h2>

            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width:60px;">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Country</th>
                                <th>Member Since</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recent_users as $key => $user)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $user->fname }} {{ $user->lname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->getCountry() ?? 'Not Available' }}</td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                <td><button class="btn btn-info btn-sm">View</button></td>
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
