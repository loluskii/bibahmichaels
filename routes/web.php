<?php

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\CurrencyController;
use Illuminate\Foundation\Auth\EmailVerificationRequest as NewRegistrationVerificationEmail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BaseController::class,'index'])->name('home');
Route::post('currency_load',[CurrencyController::class, 'currencyLoad'])->name('currency.load');

Auth::routes();

Route::get('/email/verify/{id}/{hash}', function (NewRegistrationVerificationEmail $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.verify');
})->name('verification.notice')->middleware('auth');

// Route::get('update/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfillUpdateEmail();
//     return redirect('/');
// })->middleware(['auth', 'signed'])->name('verification.verify.update');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

Route::get('/collections/all',[BaseController::class,'viewShop'])->name('shop');
Route::get('/collections/{category}',[BaseController::class,'getCategory'])->name('shop.category');
Route::get('/products/{slug}',[BaseController::class,'viewProduct'])->name('shop.product.show');
Route::get('/cart',[BaseController::class,'viewCart'])->name('shop.cart');
Route::post('/add/{id}',[CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/destroy/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

//Checkout Routes
Route::get('/checkout/{session}', [PaymentController::class,'checkout'])->name('checkout.page-1');
Route::post('/checkout/store', [PaymentController::class,'contactInformation'])->name('checkout.page-1.store');
Route::get('/checkout/2/{session}', [PaymentController::class,'shipping'])->name('checkout.page-2');
Route::post('/checkout/2/store', [PaymentController::class,'postShipping'])->name('checkout.page-2.store');
Route::get('/checkout/3/{session}', [PaymentController::class,'showPayment'])->name('checkout.page-3');
Route::post('/checkout/3/store', [PaymentController::class,'getPaymentMethod'])->name('checkout.page-3.store');
Route::get('/orders/{reference}', [PaymentController::class, 'checkoutSuccessful'])->name('checkout.success');

//Payment Routes
Route::post('/pay/paystack', [PaymentController::class, 'paystackRedirectToGateway'])->name('pay.paystack');
Route::get('/payment/callback', [PaymentController::class, 'paystackHandleGatewayCallback'])->name('payment');
//Flutterwave Checkout
Route::post('/pay', [PaymentController::class, 'flutterInit'])->name('pay.flutter');
Route::get('/rave/callback', [PaymentController::class,'flutterwaveCallback'])->name('flutter.callback');

//User Routes
Route::middleware(['auth','verified'])->group(function () {
    Route::get('/user',[UserController::class, 'index'])->name('user');
});

//Custom Orders
Route::get('/custom-order', function () {
    return view('shop.custom');
})->name('custom');

//Gallery
Route::get('/gallery', function () {
    return view('cms.gallery');
})->name('gallery');


// Route::post('/bridal-order/store',[BaseController::class,'bridalOrder'])->name('store.bridal');
// Route::post('/bridal-order',[BaseController::class,'bespokeOrder'])->name('store.bespoke');

//CMS Routes
Route::get('/contact', function () {
    return view('cms.contact');
})->name('contact');

Route::get('/size-chart', function () {
    return view('cms.size-chart');
})->name('size_chart');

Route::get('/return-policy', function () {
    return view('cms.returns');
})->name('returns');

Route::get('/shipping', function () {
    return view('cms.shipping');
})->name('shipping');


Route::get('/mailtest', function () {
    return view('mail.order-invoice');
})->name('mail');


