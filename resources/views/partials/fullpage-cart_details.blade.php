<style>
    span.badge {
        top: -5px;
        right: 10px;
        /* bottom: 10px; */
        transition: all .3s ease-in-out;
    }
</style>

<div class="checkout-main">
    <div class=" pe-0 me-0 pe-md-5 me-md-5 pe-lg-5">
        <div class="product border-bottom">
            <table class="table table-borderless">
                <tbody>
                    @foreach ($cartItems as $item)
                    <tr class="d-flex align-items-center">
                        <td scope="row" style="width: 20%; position: relative;">
                            <div>
                                <img class="img-fluid img-thumbnail" style=" height: 64px; width: 64px; object-fit: contain;" src="{{ $item->associatedModel->images()->first()->url }}" alt="">
                            </div>

                                <span class="position-absolute badge bg-dark border border-light rounded-circle" style="">{{ $item->quantity }}</span>

                        </td>
                        <td style="width: 60%;">
                            <span
                                class="product__description__variant order-summary__small-text text-uppercase"
                                style="display: block;">{{ $item->name }}</span>
                        </td>
                        <td style="width: 20%; justify-content: end">
                            <div class="float-end">
                                <span class="currency">£</span>{{ number_format($item->price, 2) }}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="price border-bottom">
            <div class="d-flex justify-content-between align-items-center pt-3 pb-2">
                <span>Subtotal</span>
                <span><span class="currency">£</span>{{ number_format(Cart::session(auth()->check() ? auth()->id() : 'guest')->getSubTotal(), 2) }}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <p>Shipping</p>
                <p><small class="text-muted">Calculated at the next step</small></p>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center py-4">
            <h5>Total</h5>
            <h3>${{ number_format(Cart::session(auth()->check() ? auth()->id() : 'guest')->getTotal(), 2) }} </h3>
        </div>
    </div>
</div>
