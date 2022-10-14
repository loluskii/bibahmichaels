<?php

namespace App\Http\Controllers;

use Paystack;
use Exception;
use App\Models\User;
use App\Models\Order;
use App\Helpers\Helper;
use App\Models\Address;
use App\Models\Payment;
use App\Models\Currency;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Actions\OrderActions;
use App\Jobs\SendOrderInvoice;
use App\Services\OrderQueries;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Jobs\AdminOrderNotification;
use Illuminate\Support\Facades\Auth;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class PaymentController extends Controller
{
    public function checkout()
    {
        $cartItems = \Cart::session(Helper::getSessionID())->getContent();
        $cartTotalQuantity = \Cart::session(Helper::getSessionID())->getContent()->count();
        $order_details = session('order');
        $address = Address::where('user_id',auth()->id())->where('default',true)->first();

        if ($cartItems->count() > 0) {
            return view('checkout.page-1', compact('cartItems', 'cartTotalQuantity', 'order_details','address'));
        } else {
            return redirect()->route('shop');
        }
    }

    public function contactInformation(Request $request)
    {
        // dd($request->all());
        try {
            if (empty($request->session()->get('order'))) {
                $order = new Order;
                $order->fill($request->except('_token'));
                $request->session()->put('order', $order);
                $session = session('session');
            } else {
                $order = $request->session()->get('order');
                $session = $request->session()->get('session');
                $order->fill($request->except('_token'));
                $request->session()->put('order', $order);
            }
            // dd(session('order'));
            return redirect()->route('checkout.page-2', ['session' => $session]);
        } catch (\Exception$e) {
            return $e->getMessage();
        }
    }

    public function shipping(Request $request)
    {
        try {
            $order = $request->session()->get('order');
            // dd($order);
            $session = $request->session()->get('session');
            $cartItems = \Cart::session(Helper::getSessionID())->getContent();
            if($order->shipping_country == "United Kingdom"){
                $condition1 = new \Darryldecode\Cart\CartCondition(array(
                    'name' => 'Standard Shipping',
                    'type' => 'shipping',
                    'target' => 'total',
                    'value' => '+3.99',
                    'attributes' => array(
                        'description' => '3 - 7 working days'
                    )
                ));
            }else{
                $condition1 = new \Darryldecode\Cart\CartCondition(array(
                    'name' => 'International Shipping',
                    'type' => 'shipping',
                    'target' => 'total',
                    'value' => '+15',
                    'attributes' => array(
                        'description' => '3 - 7 working days'
                    )
                ));
            }
            $condition2 = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'Express Shipping',
                'type' => 'shipping',
                'target' => 'total',
                'value' => '+6.99',
                'attributes' => array(
                    'description' => '1 - 3 working days'
                )
            ));
            \Cart::session(Helper::getSessionID())->condition($condition1);
            $conditionValue = $condition1->getValue();
            $conditionName = $condition1->getName();
            // dd($conditionValue);
            return view('checkout.page-2', compact('order', 'cartItems','conditionName', 'conditionValue', 'session'));
        } catch (\Exception$e) {
            return back()->with('An error occured', 'error');
        }
    }

    public function setShipping(Request $request){

    }

    public function postShipping(Request $request)
    {
        try {
            $order = $request->session()->get('order');
            $session = $request->session()->get('session');
            $order->fill($request->all());
            $request->session()->put('order', $order);
            return redirect()->route('checkout.page-3', ['session' => $session]);
        } catch (\Exception$e) {
            return $e->getMessage();
        }
    }

    public function showPayment(Request $request)
    {
        try {
            $order = $request->session()->get('order');
            $session = $request->session()->get('session');
            $cartItems = \Cart::session(Helper::getSessionID())->getContent();
            $condition = \Cart::getCondition('Standard Shipping');
            if($order->shipping_country == "United Kingdom"){
                $condition = \Cart::getCondition('Standard Shipping');
            }else{
                $condition = \Cart::getCondition('International Shipping');
            }
            $condition_name = $condition->getName(); // the name of the condition
            $condition_value = $condition->getValue(); // the value of the condition
            // dd(session()->get('order'));
            return view('checkout.page-3', compact('order', 'cartItems', 'condition_name', 'condition_value', 'session'));
        } catch (\Exception$th) {
            return $th->getMessage();
        }
    }

    public function getPaymentMethod(Request $request)
    {
        $currency = session('currency_code') ?? session('system_default_currency_info')->code;
        if ($request->payment_method == "paystack") {
            $order = $request->session()->get('order');
            $reference = Paystack::genTranxRef();
            $amount = Helper::currency_converter(\Cart::session(Helper::getSessionID())->getTotal());
            $email = $order->shipping_email;
            $metadata = [
                'order' => $request->session()->get('order'),
                'cart' => \Cart::session(Helper::getSessionID())->getContent(),
                'subamount' => \Cart::session(Helper::getSessionID())->getSubTotal(),
            ];
            $request->merge(['metadata' => $metadata, 'reference' => $reference, 'currency' => $currency, 'amount' => $amount * 100, 'email' => $email]);
            return $this->paystackRedirectToGateway($request);
        } else if ($request->payment_method == "flutterwave") {
            $order = $request->session()->get('order');
            $amount = Helper::currency_converter(\Cart::session(Helper::getSessionID())->getTotal());
            $email = $order->shipping_email;
            $metadata = [
                'order' => $request->session()->get('order'),
                'cart' => \Cart::session(Helper::getSessionID())->getContent(),
                'subamount' => \Cart::session(Helper::getSessionID())->getSubTotal(),
            ];
            $request->merge(['meta' => $metadata, 'currency' => $currency, 'amount' => $amount, 'email' => $email]);
            return $this->flutterInit($request);
        } else if ($request->payment_method == "stripe") {
            $amount = Helper::currency_converter(\Cart::session(Helper::getSessionID())->getTotal());
            $request->merge([ 'currency' => $currency, 'amount' => $amount]);
            return $this->stripeInit($request);
        }
    }

    /**
     * Stripe Payment functions
     *
     * @return void
     */

    //Redirect to stripe checkout
    public function stripeInit(Request $request)
    {
        // dd(round($request->amount,2));
        try {
            $cart = \Cart::session(auth()->check() ? auth()->id() : 'guest')->getContent();
            $x = [];
            foreach ($cart as $key => $value) {
                $x[] = array($value['id'], $value['price'], $value['quantity'], $value['attributes']['size'], $value['attributes']['color'] ?? null);
            }
            $ref = Str::random(20);
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $checkout_session = \Stripe\Checkout\Session::create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => $request->currency,
                            'product_data' => [
                                'name' => 'Order from Bibah Michael',
                            ],
                            'unit_amount' => round($request->amount, 2) * 100,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'payment_intent_data' => [
                    'metadata' => [
                        'ref' => $ref,
                        'order' => $request->session()->get('order'),
                        'subamount' => \Cart::session(Helper::getSessionID())->getSubTotal(),
                        'user_id' => auth()->id() ?? rand(0000, 9999),
                        'order_items' => json_encode($x),
                        'currency' => $request->currency,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('stripe.redirect', $ref),
                'cancel_url' => route('checkout.page-3', session()->get('session')),
            ]);
            return redirect()->away($checkout_session->url);

        } catch (\Exception $th) {
            return $th;
        }
    }

    // //Handle Stripe Webhook
    public function stripeWebhook(Request $request)
    {
        try {
            $data = $request->all();
            $method = "stripe";
            $metadata = $data['data']['object']['metadata'];

            switch ($data['type']) {
                case 'charge.succeeded':
                    $subamount = $metadata['subamount'];
                    $amount = $data['data']['object']['amount'] / 100;
                    $payment_id = $data['data']['object']['id'];
                    $order_items = $metadata['order_items'];
                    $user_id = $metadata['user_id'];
                    $currency = Currency::where('code', '=', $metadata['currency'])->first();
                    $ref = $metadata['ref'] ?? '';
                    $res = OrderActions::store($ref, json_decode($metadata['order']), $amount, $subamount, $user_id, $method, $currency, json_decode($metadata['order_items']));

                    $newOrder = (new OrderQueries())->findByRef($res);
                    if ($newOrder) {
                        DB::beginTransaction();
                        if (Payment::where('payment_ref', $payment_id)->first()) {
                            throw new Exception('Payment Already made!');
                        }
                        $payment = new Payment();
                        $payment->user_id = auth()->id() ?? $newOrder->user_id;
                        $payment->order_id = $newOrder->id;
                        $payment->amount = $amount;
                        $payment->description = 'Payment for Order ' . $newOrder->order_number;
                        $payment->payment_ref = $payment_id;
                        $payment->save();
                        DB::commit();
                    }
                    $user = $newOrder->shipping_email;
                    $admin = User::where('is_admin', 1)->get();
                    AdminOrderNotification::dispatch($newOrder, $admin)->delay(now()->addMinutes(1));;
                    SendOrderInvoice::dispatch($newOrder, $user)->delay(now()->addMinutes(3));

                    \Cart::session(Helper::getSessionID())->clear();
                    request()->session()->forget('order');
                    request()->session()->forget('session');

                    return 'webhook captured!';
                    break;
                default:
                    return abort(404);
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    public function stripeRedirect($ref){
        return redirect()->route('checkout.success', $ref);
    }

    /**
     * Paypal Payment functions
     *
     * @return void
     */


    public function paypalCreate(Request $request){
        try {
            $cart = \Cart::session(auth()->check() ? auth()->id() : 'guest')->getContent();
            $x = [];
            foreach ($cart as $key => $value) {
                $x[] = array($value['id'], $value['price'], $value['quantity'], $value['attributes']['size'], $value['attributes']['color'] ?? null);
            }

            $ref = $request->id;
            $order  = $request->session()->get('order');
            $amount = $request->amount;
            $subamount = $request->subamount;
            $user_id = $request->user_id;
            $method = "Paypal";
            $currency = Currency::where('code', '=', $request->currency)->first();
            $order_items = $x;
            // dd($order_items);
            $payment_id = $request->payment_id;
            $response = OrderActions::store($ref, $order, $amount, $subamount, $user_id, $method, $currency, $order_items);
            // dd($response);

            if($response){
                $newOrder = (new OrderQueries())->findByRef($response);
                if ($newOrder) {
                    DB::beginTransaction();
                    if (Payment::where('payment_ref', $payment_id)->first()) {
                        throw new Exception('Payment Already made!');
                    }
                    $payment = new Payment();
                    $payment->user_id = auth()->id() ?? $newOrder->user_id;
                    $payment->order_id = $newOrder->id;
                    $payment->amount = $amount;
                    $payment->description = 'Payment for Order ' . $newOrder->order_number;
                    $payment->payment_ref = $payment_id;
                    $payment->save();
                    DB::commit();
                }

                $user = $newOrder->shipping_email;
                $admin = User::where('is_admin', 1)->get();
                AdminOrderNotification::dispatch($newOrder, $admin)->delay(now()->addMinutes(1));;
                SendOrderInvoice::dispatch($newOrder, $user)->delay(now()->addMinutes(3));

                \Cart::session(Helper::getSessionID())->clear();
                request()->session()->forget('order');
                request()->session()->forget('session');

                // dd($ref);
                return response()->json([
                    'message' => 'Order Stored Successfully',
                    'ref' => $ref,
                ], 200);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function checkoutSuccessful($ref)
    {
        try {
            $order = OrderQueries::findByRef($ref);
            $currency = Currency::where('code', $order->order_currency)->first();
            // /
            if ($order) {
                return view('shop.order-success', compact('order', 'currency'));
            } else {
                abort(404);
            }
        } catch (\Exception $th) {
            return $th->getMessage();
        }

    }
}
