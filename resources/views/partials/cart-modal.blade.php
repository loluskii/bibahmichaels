<div class="modal modal-right fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog w-75" role="document">
        <div class="modal-content p-4">
            <div class="modal-header">
                <h5 class="modal-title">SHOPPING BAG</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-1">
                @php
                    $cartItems = \Cart::session(auth()->check() ? auth()->id() : 'guest')->getContent();
                @endphp
                @foreach ($cartItems as $item)
                    <div class="d-flex border-bottom  py-3">
                        {{-- <div class="d-flex w-100"> --}}
                            <img src="{{ $item->associatedModel->images()->first()->url ?? '' }}"
                                class="img-fluid" style="height: 150px;" alt="" srcset="">
                            <div class="ms-3 d-flex flex-column">
                                <h6 class="mb-auto text-uppercase" style="line-height: 1.2">{{ $item->name }}</h6>

                                <form action="{{route('cart.update', $item->id)}}" method="POST">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <button class="btn px-2 btn-sm rounded-0 minus fw-bold" style="color: #bbb" type="button"
                                            id="button-addon1">-</button>
                                        <input type="text" value="{{ $item->quantity }}" name="quantity" onchange="this.form.submit()" readonly
                                            class="bg-white form-control w-25 text-center border-start-0 border-end-0"
                                            aria-label="Amount (to the nearest dollar)">
                                        <button class="btn btn-sm px-2 plus rounded-0 fw-bold" style="color: #bbb" type="button"
                                            id="button-addon2">+</button>
                                    </div>
                                </form>
                                <div class="d-flex justify-content-between">

                                    <small>${{ number_format($item->price) }}</small>
                                    <small class="bg-light mb-2"><a class="ps-1" style="font-size: 13px" href="{{ route('cart.destroy', $item->id) }}">DELETE</a></small>
                                </div>
                            </div>
                            {{-- <div class="ms-4 d-flex flex-column">
                                <p>{{ $item->name }}</p>
                                <div class="d-flex mt-auto">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                        @csrf
                                        <input type="number" onchange="this.form.submit()" class="qty-text me-5"
                                            id="qty2" step="1" min="1" max="99" name="quantity"
                                            style="width: 50px; text-align: center; border-radius: 3px; border: 1px solid rgb(228, 228, 228)"
                                            value="{{ $item->quantity }}">
                                    </form>
                                    <p class="me-5">${{ number_format($item->price, 2) }}</p>
                                    <a href="{{ route('cart.destroy', $item->id) }}">
                                        <small> DELETE</small>
                                    </a>

                                </div>
                            </div> --}}
                        {{-- </div> --}}
                        {{-- <td>${{ $item->price }}</td> --}}

                    </div>
                @endforeach
                <div class="d-flex justify-content-between mt-3">
                    <small>SUBTOTAL</small>
                    <p class="mb-0 fw-bold">{{ $currency_symbol }}{{ number_format(App\Helpers\Helper::currency_converter(\Cart::session(App\Helpers\Helper::getSessionID())->getTotal()), 2) }}</p>

                </div>

                <a href="{{ route('checkout.page-1',session()->get('session')) }}" class="btn btn-dark btn-block w-100 btn-lg rounded-0 fw-bold py-3  mt-3 {{ $cartItems->count() > 0 ? '' : 'disabled' }}">CHECKOUT</a>
                <div class="text-center">
                    <small class="text-center" style="font-size: 10px">SHIPPING & TAXES CALCULATED AT CHECKOUT</small>
                </div>

            </div>

        </div>
    </div>
</div>
