<div class="modal modal-left fade" id="mobileSideNav" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog w-75" role="document">
        <div class="modal-content p-4">
            <div class="modal-header border-0 justify-content-start">
                {{-- <h5 class="modal-title">SHOPPING BAG</h5> --}}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row h-100">
                    <div class="col-12">


                            <div class="py-4 border-bottom">
                                <a class="text-decoration-none text-uppercase" style="font-weight: 500; font-size: 0.9rem;" href="{{ route('home') }}">HOME</a>
                            </div>

                            <div class="accordion accordion-flush py-2 border-bottom" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="ps-0 accordion-button collapsed" style="font-weight: 500;" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            SHOP
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body bg-white border-0 px-1">
                                            @php
                                            $categories = App\Models\Category::all();
                                            @endphp
                                            {{-- <ul class="list-unstyled"> --}}
                                                @foreach ($categories as $category)
                                                <div class="py-2">
                                                    <a class="text-muted"
                                                        style="font-weight: 800; font-size: 13px; text-transform: uppercase; text-decoration: none"
                                                        href="{{ route('shop.category',$category->slug) }}">{{ $category->name }}</a>
                                                </div>
                                                @endforeach
                                            {{-- </ul> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="py-4 border-bottom">
                                <a class="text-decoration-none text-uppercase" style="font-weight: 500; font-size: 0.9rem;" href="{{ route('shop') }}">BRIDAL</a>
                            </div>
                            <div class="py-4 border-bottom">
                                <a class="text-decoration-none text-uppercase" style="font-weight: 500; font-size: 0.9rem;" href="{{ route('shop') }}">BESPOKE</a>
                            </div>
                            <div class="py-4 border-bottom">
                                <a class="text-decoration-none text-uppercase" style="font-weight: 500; font-size: 0.9rem;" href="{{ route('shop') }}">CONTACT</a>
                            </div>
                            @if (Auth::check())
                            <div class=" py-4">
                                <a class=""
                                    style="font-weight: 800; font-size: 17px; text-transform: uppercase; text-decoration: none"
                                    href="{{ route('user') }}">ACCOUNT</a>
                            </div>
                            <div class=" py-4">
                                <a class=""
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    style="font-weight: 800; font-size: 1.5rem; text-transform: uppercase; text-decoration: none"
                                    href="">LOG OUT</a>
                            </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            @else
                            <div class=" py-4">
                                <a class=""
                                    style="font-weight: 800; font-size: 15px; text-transform: uppercase; text-decoration: none"
                                    href="{{ route('login') }}">LOG IN</a>
                            </div>
                            @endif
                            {{-- <li class="nav-item">
                                <a class="nav-link py-3"
                                    style="font-weight: 800; font-size: 15px; text-decoration: none" href="">About
                                    us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3"
                                    style="font-weight: 800; font-size: 15px; text-decoration: none"
                                    href="">Shipping</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3"
                                    style="font-weight: 800; font-size: 15px; text-decoration: none" href="">Contact</a>
                            </li> --}}

                        {{-- </ul> --}}
                    </div>
                </div>



            </div>
            {{-- <div class="d-flex justify-content-between modal-footer">
                <h4 class="font-weight-bold">${{ number_format(Cart::auth()->check() ? auth()->id() :
                    'guest'->getTotal(),2 )}}</h4>
                <a href="{{ route('checkout.index') }}"
                    class="btn btn-dark btn-block btn-lg {{ $cartItems->count() > 0 ? '':'disabled' }}">CHECKOUT</a>
            </div> --}}
        </div>
    </div>
</div>
