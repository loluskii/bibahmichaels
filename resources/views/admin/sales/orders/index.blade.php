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
                            @if ($orders->count() > 0)
                            @foreach ($orders as $key => $order)
                            @php
                            if($order->status == 1){
                            // $color == null;
                            $status = 'Payment Confirmed';
                            }elseif ($order->status == 2) {
                            // $color = null;
                            $status = 'Awaiting Pickup';
                            }elseif ($order->status == 3) {
                            // $color = null;
                            $status = 'Shipping in Progress';
                            }elseif ($order->status == 4) {
                            // $color = 'bg-warning';
                            $status = 'Shipped';
                            }elseif ($order->status == 5) {
                            // $color = 'bg-success';
                            $status = 'Delivered';
                            }elseif ($order->status == 6) {
                            $color = 'bg-danger';
                            $status = 'Cancelled';
                            }else {
                            $color = 'bg-secondary';
                            $status = 'Unknown';
                            }
                            @endphp
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $order->order_reference }}</td>
                                <td>{{ $order->shipping_email }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td>{{ $order->order_currency }} {{ number_format($order->grand_total, 2) }}</td>
                                <td><span class="badge badge-success">{{ $status }}</span></td>
                                <td><a href="{{ route('admin.orders.show', $order->order_reference) }}"
                                        class="btn btn-info btn-sm">View</a></td>
                            </tr>
                            @endforeach
                            @else
                            <tr class="text-center">
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

@endsection
