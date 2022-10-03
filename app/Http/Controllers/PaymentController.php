<?php

namespace App\Http\Controllers;

use App\Actions\OrderActions;
use App\Helpers\Helper;
use App\Jobs\AdminOrderNotification;
use App\Jobs\SendOrderInvoice;
use App\Models\Currency;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Services\OrderQueries;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use KingFlamez\Rave\Facades\Rave as Flutterwave;
use Paystack;

class PaymentController extends Controller
{
    public function checkout()
    {
        $cartItems = \Cart::session(Helper::getSessionID())->getContent();
        $cartTotalQuantity = \Cart::session(Helper::getSessionID())->getContent()->count();
        $order_details = session('order');
        if ($cartItems->count() > 0) {
            return view('checkout.page-1', compact('cartItems', 'cartTotalQuantity', 'order_details'));
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
            if($cartItems->count() == 1){
                if($order->shipping_country == "United Kingdom"){
                    $condition = new \Darryldecode\Cart\CartCondition(array(
                        'name' => 'Standard Shipping',
                        'type' => 'shipping',
                        'target' => 'total',
                        'value' => '+3.99',
                    ));
                }else{
                    $condition = new \Darryldecode\Cart\CartCondition(array(
                        'name' => 'International Shipping',
                        'type' => 'shipping',
                        'target' => 'total',
                        'value' => '+8.99',
                    ));
                }
            }else{
                if($order->shipping_country == "United Kingdom"){
                    $delivery_fee = floatval(5 + floatval($cartItems->count() * 1.5));
                    $condition = new \Darryldecode\Cart\CartCondition(array(
                        'name' => 'Standard Shipping',
                        'type' => 'shipping',
                        'target' => 'total',
                        'value' => '+'.$delivery_fee,
                    ));
                }else{
                    $delivery_fee = floatval(15.99 + floatval($cartItems->count() * 1.5));
                    $condition = new \Darryldecode\Cart\CartCondition(array(
                        'name' => 'International Shipping',
                        'type' => 'shipping',
                        'target' => 'total',
                        'value' => '+'.$delivery_fee,
                    ));
                }
            }
            \Cart::session(Helper::getSessionID())->condition($condition);
            $conditionValue = $condition->getValue();
            $conditionName = $condition->getName();
            // dd($conditionValue);
            return view('checkout.page-2', compact('order', 'cartItems','conditionName', 'conditionValue', 'session'));
        } catch (\Exception$e) {
            return back()->with('An error occured', 'error');
        }
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
     * Flutterwave Payment functions
     *
     * @return void
     */
    public function flutterInit(Request $request)
    {
        // dd($request->meta);
        try {
            $data = [
                "payment_options" => 'card,banktransfer',
                "amount" => $request->amount,
                "email" => Auth::user()->email ?? $request->email,
                "tx_ref" => Flutterwave::generateReference(),
                "currency" => $request->currency,
                "redirect_url" => route('flutter.callback'),
                "meta" => ['data' => ['data' => 'data']],
                "customer" => [
                    "email" => Auth::user()->email ?? $request->email,
                    "name" => $request->name,
                ],
                "customizations" => [
                    "title" => 'Bibah Michael',
                    "description" => Carbon::now(),
                ],
            ];
            $payment = Flutterwave::initializePayment($data);
            // return $payment;
            if ($payment['status'] !== 'success') {
                // notify something went wrong
                return back()->with('error', 'Oops! Something went wrong.');
            }
            return redirect($payment['data']['link']);
        } catch (\Exception$th) {
            return $th->getMessage();
        }
    }

    public function flutterwaveCallback()
    {
        $currency = session('currency_code') ?? session('system_default_currency_info')->code;
        if (request()->status == "cancelled") {
            return redirect()->route("checkout.page-3", ['session', session()->get('session')])->with("error", "Transaction Cancelled");
        } else if (request()->status == "successful") {
            $transactionID = Flutterwave::getTransactionIDFromCallback();
            $data = Flutterwave::verifyTransaction($transactionID);
            $txn_ref = $data['data']['flw_ref'];
            $order = session()->get('order');
            $amount = $data['data']['amount'];
            $subamount = \Cart::session(Helper::getSessionID())->getSubTotal();
            $user_id = auth()->check() ? auth()->id() : rand(0000, 9999);
            $method = 'flutterwave';
            $currency = Currency::where('code', '=', $data['data']['currency'])->first();
            $cart = \Cart::session(Helper::getSessionID())->getContent();
            // store order
            $res = OrderActions::store($order, $amount, $subamount, $user_id, $method, $currency, $cart);
            $newOrder = OrderQueries::findByRef($res);

            DB::beginTransaction();
            if (Payment::where('payment_ref', $transactionID)->first()) {
                throw new Exception('Duplicate transaction');
            } else {
                $payment = new Payment();
                $payment->user_id = $newOrder->user_id;
                $payment->order_id = $newOrder->id;
                $payment->amount = $amount;
                $payment->currency = $newOrder->order_currency;
                $payment->description = 'Payment for Order ' . $newOrder->order_number;
                $payment->payment_ref = $txn_ref;
                $payment->save();
                DB::commit();

                $admin = User::where('is_admin', 1)->get();
                $user = $newOrder->shipping_email;

                \Cart::session(auth()->check() ? auth()->id() : 'guest')->clear();
                request()->session()->forget('order');
                request()->session()->forget('session');

                AdminOrderNotification::dispatch($newOrder, $admin);
                SendOrderInvoice::dispatch($newOrder, $user)->delay(now()->addMinutes(3));

                return redirect()->route('checkout.success', ['reference' => encrypt($newOrder->order_reference)]);
            }
        } else {
            abort(500);
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
                'success_url' => route('stripe.redirect', encrypt($ref)),
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
        // return decrypt('eyJpdiI6IlRSNWxNd2I1NE5WN1pwaUpoaTJLdXc9PSIsInZhbHVlIjoiTnJkS3hDNC9NcGVZeEdyRlZhVWtnT2pyZ2NNajBPQ0tLbjM1aERBUVkwOD0iLCJtYWMiOiIzNTI4MDU2MTI2ODE2OTIwNTY0YmU2NGFhNmUxZGEyYTZkZGUxMWMyNGZkM2Y3NGYwOGM2ZDFhZmMwNTkwMWQzIiwidGFnIjoiIn0=');
        return redirect()->route('checkout.success', $ref);
    }

    public function checkoutSuccessful($ref)
    {
        try {
            $order = OrderQueries::findByRef(decrypt($ref));
            $currency = Currency::where('code', $order->order_currency)->first();
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
