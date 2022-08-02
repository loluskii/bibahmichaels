<style>
    footer {
        padding-top: 50px;
        padding-bottom: 50px;
    }

    .Linklist {
        list-style-type: none;
        padding-left: 0;
    }

    .Linklist__Item,
    .Linklist__Item a,
    .Footer__Block p,
    .Footer__Copyright a {
        text-decoration: none;
        font-weight: 300;
        color: gray;
        padding-bottom: 10px
    }

    .Footer__Title {
        font-size: 1.1rem;
        padding-bottom: 10px;
        text-transform: uppercase
    }

    .Footer__PaymentList {
        list-style-type: none;
        display: inline-flex;
    }
</style>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-2 col-12 mb-4">
                <div class="Footer__Block Footer__Block--links">
                    <h2 class="Footer__Title Heading u-h6">Help</h2>

                    <ul class="Linklist">
                        <li class="Linklist__Item">
                            <a href="/pages/contact-us" class="Link Link--primary">Contact Us</a>
                        </li>
                        <li class="Linklist__Item">
                            <a href="/pages/frequently-asked-questions" class="Link Link--primary">FAQs</a>
                        </li>
                        <li class="Linklist__Item">
                            <a href="https://nuraniya-studios.myshopify.com/apps/sizings?id=16613353"
                                class="Link Link--primary">Size Chart</a>
                        </li>
                        <li class="Linklist__Item">
                            <a href="/pages/shipping" class="Link Link--primary">Shipping</a>
                        </li>
                        <li class="Linklist__Item">
                            <a href="/pages/returns-exchanges" class="Link Link--primary">Returns &amp; Exchanges</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 col-12 mb-4">
                <div class="Footer__Block Footer__Block--links">
                    <h2 class="Footer__Title Heading u-h6">Information</h2>

                    <ul class="Linklist">
                        <li class="Linklist__Item">
                            <a href="/pages/contact-us" class="Link Link--primary">Terms of Service</a>
                        </li>
                        <li class="Linklist__Item">
                            <a href="/pages/frequently-asked-questions" class="Link Link--primary">Privacy Policy</a>
                        </li>
                        <li class="Linklist__Item">
                            <a href="/pages/frequently-asked-questions" class="Link Link--primary">Cookie Policy</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 col-12 mb-4">
                <div class="Footer__Block Footer__Block--links">
                    <h2 class="Footer__Title Heading u-h6">SIGN UP FOR OUR NEWSLETTER</h2>
                    <p class="mb-0">Subscribe to receive updates, access to exclusive deals, and more.</p>
                    <form action="">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label"></label>
                            <input type="text" name="" id="" class="form-control form-control-lg rounded-0"
                                placeholder="Enter your email address" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">We won't share your email</small>
                        </div>
                        <button class="btn btn-dark rounded-0">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="col-md-1 col-lg-1"></div>
            <div class="col-md-3 col-lg-3 col-12 mb-4">
                <div class="Footer__Block Footer__Block--links">
                    <h2 class="Footer__Title Heading u-h6">Follow us</h2>

                    <ul class="Linklist">
                        <li class="Linklist__Item">
                            <a href="/pages/contact-us" class="Link Link--primary me-4"><i
                                    class="fa-brands fa-facebook-f"></i></a>
                            <a href="/pages/contact-us" class="Link Link--primary"><i
                                    class="fa-brands fa-instagram"></i></a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="Footer__Aside mt-5 row justify-content-between">
            <div class="col-md-6 Footer__Copyright text-lg-start text-md-start text-center">
                <a href="/" class="Footer__StoreName Heading u-h7 Link Link--secondary">© BIBAH MICHAEL</a>
            </div>
            <hr class="d-md-none d-lg-none d-block">
            <div class="col-md-6 text-lg-end text-md-end text-center">
                <ul class="Footer__PaymentList HorizontalList mb-0">
                    <li class="HorizontalList__Item mx-2"><svg xmlns="http://www.w3.org/2000/svg" role="img"
                            viewBox="0 0 38 24" width="38" height="24" aria-labelledby="pi-american_express">
                            <title id="pi-american_express">American Express</title>
                            <g fill="none">
                                <path fill="#000"
                                    d="M35,0 L3,0 C1.3,0 0,1.3 0,3 L0,21 C0,22.7 1.4,24 3,24 L35,24 C36.7,24 38,22.7 38,21 L38,3 C38,1.3 36.6,0 35,0 Z"
                                    opacity=".07"></path>
                                <path fill="#006FCF"
                                    d="M35,1 C36.1,1 37,1.9 37,3 L37,21 C37,22.1 36.1,23 35,23 L3,23 C1.9,23 1,22.1 1,21 L1,3 C1,1.9 1.9,1 3,1 L35,1">
                                </path>
                                <path fill="#FFF"
                                    d="M8.971,10.268 L9.745,12.144 L8.203,12.144 L8.971,10.268 Z M25.046,10.346 L22.069,10.346 L22.069,11.173 L24.998,11.173 L24.998,12.412 L22.075,12.412 L22.075,13.334 L25.052,13.334 L25.052,14.073 L27.129,11.828 L25.052,9.488 L25.046,10.346 L25.046,10.346 Z M10.983,8.006 L14.978,8.006 L15.865,9.941 L16.687,8 L27.057,8 L28.135,9.19 L29.25,8 L34.013,8 L30.494,11.852 L33.977,15.68 L29.143,15.68 L28.065,14.49 L26.94,15.68 L10.03,15.68 L9.536,14.49 L8.406,14.49 L7.911,15.68 L4,15.68 L7.286,8 L10.716,8 L10.983,8.006 Z M19.646,9.084 L17.407,9.084 L15.907,12.62 L14.282,9.084 L12.06,9.084 L12.06,13.894 L10,9.084 L8.007,9.084 L5.625,14.596 L7.18,14.596 L7.674,13.406 L10.27,13.406 L10.764,14.596 L13.484,14.596 L13.484,10.661 L15.235,14.602 L16.425,14.602 L18.165,10.673 L18.165,14.603 L19.623,14.603 L19.647,9.083 L19.646,9.084 Z M28.986,11.852 L31.517,9.084 L29.695,9.084 L28.094,10.81 L26.546,9.084 L20.652,9.084 L20.652,14.602 L26.462,14.602 L28.076,12.864 L29.624,14.602 L31.499,14.602 L28.987,11.852 L28.986,11.852 Z">
                                </path>
                            </g>
                        </svg>
                    </li>
                    <li class="HorizontalList__Item mx-2"><svg viewBox="0 0 38 24" xmlns="http://www.w3.org/2000/svg"
                            role="img" width="38" height="24" aria-labelledby="pi-master">
                            <title id="pi-master">Mastercard</title>
                            <path opacity=".07"
                                d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z">
                            </path>
                            <path fill="#fff"
                                d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32"></path>
                            <circle fill="#EB001B" cx="15" cy="12" r="7"></circle>
                            <circle fill="#F79E1B" cx="23" cy="12" r="7"></circle>
                            <path fill="#FF5F00"
                                d="M22 12c0-2.4-1.2-4.5-3-5.7-1.8 1.3-3 3.4-3 5.7s1.2 4.5 3 5.7c1.8-1.2 3-3.3 3-5.7z">
                            </path>
                        </svg></li>
                    <li class="HorizontalList__Item mx-2"><svg viewBox="0 0 38 24" xmlns="http://www.w3.org/2000/svg"
                            width="38" height="24" role="img" aria-labelledby="pi-paypal">
                            <title id="pi-paypal">PayPal</title>
                            <path opacity=".07"
                                d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z">
                            </path>
                            <path fill="#fff"
                                d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32"></path>
                            <path fill="#003087"
                                d="M23.9 8.3c.2-1 0-1.7-.6-2.3-.6-.7-1.7-1-3.1-1h-4.1c-.3 0-.5.2-.6.5L14 15.6c0 .2.1.4.3.4H17l.4-3.4 1.8-2.2 4.7-2.1z">
                            </path>
                            <path fill="#3086C8"
                                d="M23.9 8.3l-.2.2c-.5 2.8-2.2 3.8-4.6 3.8H18c-.3 0-.5.2-.6.5l-.6 3.9-.2 1c0 .2.1.4.3.4H19c.3 0 .5-.2.5-.4v-.1l.4-2.4v-.1c0-.2.3-.4.5-.4h.3c2.1 0 3.7-.8 4.1-3.2.2-1 .1-1.8-.4-2.4-.1-.5-.3-.7-.5-.8z">
                            </path>
                            <path fill="#012169"
                                d="M23.3 8.1c-.1-.1-.2-.1-.3-.1-.1 0-.2 0-.3-.1-.3-.1-.7-.1-1.1-.1h-3c-.1 0-.2 0-.2.1-.2.1-.3.2-.3.4l-.7 4.4v.1c0-.3.3-.5.6-.5h1.3c2.5 0 4.1-1 4.6-3.8v-.2c-.1-.1-.3-.2-.5-.2h-.1z">
                            </path>
                        </svg></li>
                    <li class="HorizontalList__Item mx-2"><svg viewBox="0 0 38 24" xmlns="http://www.w3.org/2000/svg"
                            role="img" width="38" height="24" aria-labelledby="pi-visa">
                            <title id="pi-visa">Visa</title>
                            <path opacity=".07"
                                d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z">
                            </path>
                            <path fill="#fff"
                                d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32"></path>
                            <path
                                d="M28.3 10.1H28c-.4 1-.7 1.5-1 3h1.9c-.3-1.5-.3-2.2-.6-3zm2.9 5.9h-1.7c-.1 0-.1 0-.2-.1l-.2-.9-.1-.2h-2.4c-.1 0-.2 0-.2.2l-.3.9c0 .1-.1.1-.1.1h-2.1l.2-.5L27 8.7c0-.5.3-.7.8-.7h1.5c.1 0 .2 0 .2.2l1.4 6.5c.1.4.2.7.2 1.1.1.1.1.1.1.2zm-13.4-.3l.4-1.8c.1 0 .2.1.2.1.7.3 1.4.5 2.1.4.2 0 .5-.1.7-.2.5-.2.5-.7.1-1.1-.2-.2-.5-.3-.8-.5-.4-.2-.8-.4-1.1-.7-1.2-1-.8-2.4-.1-3.1.6-.4.9-.8 1.7-.8 1.2 0 2.5 0 3.1.2h.1c-.1.6-.2 1.1-.4 1.7-.5-.2-1-.4-1.5-.4-.3 0-.6 0-.9.1-.2 0-.3.1-.4.2-.2.2-.2.5 0 .7l.5.4c.4.2.8.4 1.1.6.5.3 1 .8 1.1 1.4.2.9-.1 1.7-.9 2.3-.5.4-.7.6-1.4.6-1.4 0-2.5.1-3.4-.2-.1.2-.1.2-.2.1zm-3.5.3c.1-.7.1-.7.2-1 .5-2.2 1-4.5 1.4-6.7.1-.2.1-.3.3-.3H18c-.2 1.2-.4 2.1-.7 3.2-.3 1.5-.6 3-1 4.5 0 .2-.1.2-.3.2M5 8.2c0-.1.2-.2.3-.2h3.4c.5 0 .9.3 1 .8l.9 4.4c0 .1 0 .1.1.2 0-.1.1-.1.1-.1l2.1-5.1c-.1-.1 0-.2.1-.2h2.1c0 .1 0 .1-.1.2l-3.1 7.3c-.1.2-.1.3-.2.4-.1.1-.3 0-.5 0H9.7c-.1 0-.2 0-.2-.2L7.9 9.5c-.2-.2-.5-.5-.9-.6-.6-.3-1.7-.5-1.9-.5L5 8.2z"
                                fill="#142688"></path>
                        </svg></li>
                </ul>
            </div>

        </div>
    </div>
</footer>
