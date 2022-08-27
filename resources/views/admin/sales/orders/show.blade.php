@extends('admin.layout.app')

@section('title')
Order {{ $order->order_number }}
@endsection

@section('styles')
<style>
    .table>tbody>tr>.no-line {
        border-top: none;
    }

    .table>thead>tr>.no-line {
        border-bottom: none;
    }

    .table>tbody>tr>.thick-line {
        border-top: 2px solid;
    }
</style>

@endsection

@section('content')
<div class="row clearfix w-100">
    <div class="col-lg-3 col-md-6">
        <div class="card overflowhidden">
            <div class="body">
                <h3>{{ $currency->symbol }} {{ number_format($order->subtotal, 2) }} <i class="icon-briefcase float-right"></i></h3>
                <span>Order Total</span>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card overflowhidden">
            <div class="body">
                <h3>{{ $order->item_count }}<i class="icon-clock float-right"></i></h3>
                <span>Item Count</span>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix w-100">
    <div class="col-12">
        <div class="card shadow-none mb-4">
            <div class="card-body text-dark py-4">
                <div class="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between text-dark">
                                <h3>Invoice</h2>
                                    {{-- <h5><button class="btn btn-sm btn-primary">Update Status</button></h5> --}}
                                    @if ($order->status != 5)
                                    <button data-toggle="modal" data-target="#update{{ $order->order_reference }}"
                                        class="btn btn-primary btn-sm">Update Status</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="update{{ $order->order_reference }}" tabindex="-1"
                                        role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Order</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal"
                                                        aria-label="Close"><i class="fa fa-times"></i></button>
                                                </div>
                                                <div class="modal-body pb-0">
                                                    <form action="{{ route('admin.orders.update', $order->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Order Status</label>
                                                            <select class="form-control" name="status" id="">

                                                                @if ($order->status == 1)
                                                                @foreach(["2" => "Awaiting Pickup",
                                                                "3" => "Shipping In Progress", "5" =>
                                                                "Delivered","6" => "Cancelled"] AS $status =>
                                                                $statusLabel)
                                                                <option value="{{ $status }}">{{ $statusLabel }}
                                                                </option>
                                                                @endforeach
                                                                @elseif ($order->status == 2)
                                                                @foreach([ "3" => "Shipping In Progress","5" =>
                                                                "Delivered","6" => "Cancelled"] AS $status =>
                                                                $statusLabel)
                                                                <option value="{{ $status }}">{{ $statusLabel }}
                                                                </option>
                                                                @endforeach
                                                                @elseif ( $order->status == 3)
                                                                @foreach([ "5" => "Delivered","6" => "Cancelled"] AS $status => $statusLabel)
                                                                <option value="{{ $status }}">{{ $statusLabel }}
                                                                </option>
                                                                @endforeach
                                                                @elseif ( $order->status == 5)
                                                                @foreach(["6" => "Cancelled"] AS
                                                                $status => $statusLabel)
                                                                <option value="{{ $status }}">{{ $statusLabel }}
                                                                </option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @elseif ($order->status == 5)
                                    @endif
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    @php
                                    if($order->status == 1){
                                    $color = 'info';
                                    $status = 'Payment Confirmed';
                                    }elseif ($order->status == 2) {
                                    $color = 'primary';
                                    $status = 'Awaiting Pickup';
                                    }elseif ($order->status == 3) {
                                        $color = 'success';
                                        $status = 'Shipping in Progress';
                                    }elseif ($order->status == 5) {
                                    $color = 'success';
                                    $status = 'Delivered';
                                    }elseif ($order->status == 6) {
                                    $color = 'danger';
                                    $status = 'Cancelled';
                                    }else {
                                    $color = 'secondary';
                                    $status = 'Unknown';
                                    }
                                    @endphp

                                    <address>
                                        <h6>Order Information</h6>
                                        <p class="mb-1">Order Date: {{ $order->created_at->format('d M, Y') }}</p>

                                        <p class="mb-1">Method: <span class="text-capitalize">{{ $order->payment_method
                                                }}</span></p>
                                        <p class="mb-1">Status: <span class="badge badge-{{ $color ?? 'success' }}">{{
                                            $status }}</span></p>
                                        <p>Delivered on: <span>{{ $order->status == 5 ? $order->updated_at->format('d M, Y') : ''  }}</span></p>
                                    </address>
                                </div>
                                <div class="col-md-6 text-end">
                                    <address>
                                        <strong>Account Information</strong>
                                        <p>Account Name: {{ $order->user->getFullName ?? 'Guest User' }}</p>

                                        <b>Shipping Details</b> <br>
                                        {{ $order->shipping_fname }} {{ $order->shipping_lname }}<br>
                                        {{ $order->shipping_address }}<br>
                                        {{ $order->shipping_state }}
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row pt-4">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading mb-4">
                                    <h3>Order Summary</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-condensed text-start text-dark">
                                            <thead>
                                                <th>Item name</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Size</th>
                                                <th>Color</th>
                                                <th>Total</th>

                                            </thead>
                                            <tbody>
                                                <!-- foreach ($order->lineItems as $line) or some such thing here -->

                                                @foreach ($order->items as $item)
                                                @php
                                                $total = $item->pivot->quantity * $item->pivot->price;
                                                @endphp
                                                <tr>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->pivot->quantity }}</td>
                                                    <td>{{ $currency->symbol }} {{ number_format($item->pivot->price, 2) }}</td>
                                                    <td>{{ $item->pivot->size ?? 'None' }}</td>
                                                    <td>{{ $item->pivot->color ?? 'None' }}</td>
                                                    <td>{{ $currency->symbol }} {{ number_format($total, 2) }}</td>
                                                </tr>
                                                @endforeach

                                                <tr>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line text-start"><strong>Subtotal</strong>
                                                    </td>
                                                    <td class="thick-line text-start">{{ $currency->symbol }} {{
                                                        number_format($order->subtotal,2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-start"><strong>Shipping</strong>
                                                    </td>
                                                    @php
                                                    $shipping = $order->grand_total - $order->subtotal;
                                                    @endphp
                                                    <td class="no-line text-start">{{ $currency->symbol }} {{
                                                        number_format($shipping, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-start"><strong>Total</strong></td>
                                                    <td class="no-line text-start">{{ $currency->symbol }} {{
                                                        number_format($order->grand_total, 2) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


</div>

@endsection
