@extends('admin.layout.app')

@section('title')
    Bridal Orders
@endsection


@section('content')
<div class="row clearfix w-100">
    <div class="col-lg-3 col-md-6">
        <div class="card overflowhidden">
            <div class="body">
                <h3>{{ $orders->count() }} <i class="icon-briefcase float-right"></i></h3>
                <span>Total Bridal Orders</span>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Event Date</th>
                                <th>Country</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders->count() > 0)
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->index }}</td>
                                    <td>{{ $order->fname }} {{ $order->lname }}</td>
                                    <td>{{ $order->phone_number }}</td>
                                    <td>{{ $order->event_date->format('d M, Y') }}</td>
                                    <td>{{ $order->country }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td><a  href="{{ route('admin.orders.bespoke.show', $order->id) }}" class="btn btn-info btn-sm">View</a></td>
                                </tr>
                                @endforeach
                            @else
                                <tr class="text-center" >
                                    <td colspan="8">No Recent Orders</td>
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
