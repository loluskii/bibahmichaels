<?php

namespace App\Http\Controllers;

use Paystack;
use Exception;
use App\Models\User;
use App\Models\Order;
use App\Helpers\Helper;
use App\Models\Payment;
use App\Models\Currency;
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
    public function checkout(){
        $cartItems = \Cart::session(Helper::getSessionID())->getContent();
        $cartTotalQuantity = \Cart::session(Helper::getSessionID())->getContent()->count();
        $order_details = session('order');
        if($cartItems->count() > 0){
            return view('checkout.page-1', compact('cartItems','cartTotalQuantity','order_details'));
        }else{
            return redirect()->route('shop');
        }
    }

    public function contactInformation(Request $request){
        // dd($request->all());
        try {
            if(empty($request->session()->get('order'))){
                $order = new Order;
                $order->fill($request->except('_token'));
                $request->session()->put('order', $order);
                $session = session('session');
            }else{
                $order = $request->session()->get('order');
                $session = $request->session()->get('session');
                $order->fill($request->except('_token'));
                $request->session()->put('order', $order);
            }
            // dd(session('order'));
            return redirect()->route('checkout.page-2',['session'=>$session]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function shipping(Request $request){
        $order = $request->session()->get('order');
        // dd($order);
        $session = $request->session()->get('session');
        $cartItems = \Cart::session(Helper::getSessionID())->getContent();
        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'Standard Shipping',
            'type' => 'shipping',
            'target' => 'total',
            'value' => '+10',
        ));
        \Cart::session(Helper::getSessionID())->condition($condition);
        $conditionValue = $condition->getValue();
        // dd($conditionValue);
        return view('checkout.page-2', compact('order','cartItems','conditionValue','session'));
    }

    public function postShipping(Request $request){
        try {
            $order = $request->session()->get('order');
            $session = $request->session()->get('session');
            $order->fill($request->all());
            $request->session()->put('order', $order);
            return redirect()->route('checkout.page-3',['session' => $session]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function showPayment(Request $request){
        try {
            $order = $request->session()->get('order');
            $session = $request->session()->get('session');
            $cartItems = \Cart::session(Helper::getSessionID())->getContent();
            $condition = \Cart::getCondition('Standard Shipping');
            $condition_name = $condition->getName(); // the name of the condition
            $condition_value = $condition->getValue(); // the value of the condition
            return view('checkout.page-3', compact('order','cartItems','condition_name','condition_value','session'));
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    public function getPaymentMethod(Request $request){
        $currency = session('currency_code') ?? session('system_default_currency_info')->code;
        if($request->payment_method == "paystack"){
            $order = $request->session()->get('order');
            $reference = Paystack::genTranxRef();
            $amount = Helper::currency_converter(\Cart::session(Helper::getSessionID())->getTotal());
            $email = $order->shipping_email;
            $metadata = [
                'order' => $request->session()->get('order'),
                'cart' => \Cart::session(Helper::getSessionID())->getContent(),
                'subamount' => \Cart::session(Helper::getSessionID())->getSubTotal(),
            ];
            $request->merge(['metadata'=>$metadata,'reference'=>$reference, 'currency'=>$currency,'amount'=>$amount*100,'email'=>$email]);
            return $this->paystackRedirectToGateway($request);
        }
        else if($request->payment_method == "flutterwave"){
            $order = $request->session()->get('order');
            $amount = Helper::currency_converter(\Cart::session(Helper::getSessionID())->getTotal());
            $email = $order->shipping_email;
            $metadata = [
                'order' => $request->session()->get('order'),
                'cart' => \Cart::session(Helper::getSessionID())->getContent(),
                'subamount' => \Cart::session(Helper::getSessionID())->getSubTotal(),
            ];
            $request->merge(['meta'=>$metadata, 'currency'=>$currency,'amount'=>$amount,'email'=>$email]);
            return $this->flutterInit($request);
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
                "meta" => [ 'data' => ['data'=>'data'] ],
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
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    public function flutterwaveCallback()
    {
        $currency = session('currency_code') ?? session('system_default_currency_info')->code;
        if (request()->status == "cancelled") {
            return redirect()->route("checkout.page-3", ['session', session()->get('session')])->with("error", "Transaction Cancelled");
        }else if(request()->status == "successful") {
            $transactionID = Flutterwave::getTransactionIDFromCallback();
            $data = Flutterwave::verifyTransaction($transactionID);
            $txn_ref = $data['data']['flw_ref'];
            $order = session()->get('order');
            $amount = $data['data']['amount'];
            $subamount = \Cart::session(Helper::getSessionID())->getSubTotal();
            $user_id = auth()->check() ? auth()->id() : rand(0000, 9999);
            $method = 'flutterwave';
            $currency = Currency::where('code','=',$data['data']['currency'])->first();
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

                return redirect()->route('checkout.success', ['reference' => $newOrder->order_reference]);;
            }
        } else {
            abort(500);
        }
    }


    /**
     * Paystack Payment functions
     *
     * @return void
     */
    public function paystackRedirectToGateway(Request $request)
    {
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    public function paystackHandleGatewayCallback(Request $request){
        $paymentDetails = Paystack::getPaymentData();
        // dd($paymentDetails);
        $order = $paymentDetails['data']['metadata']['order'];
        $amount = $paymentDetails['data']['amount']/100;
        $subamount = $paymentDetails['data']['metadata']['subamount'];
        $user_id = auth()->check() ? auth()->id() : rand(0000, 9999);
        $method = "paystack";
        $currency = Currency::where('code',"NGN")->first();
        $cart = $paymentDetails['data']['metadata']['cart'];
        if($paymentDetails['status']){
            $res = OrderActions::store($order, $amount, $subamount, $user_id, $method, $currency, $cart);
            $newOrder = OrderQueries::findByRef($res);

            DB::beginTransaction();
            if (Payment::where('payment_ref', $paymentDetails['data']['reference'])->first()) {
                throw new Exception('Duplicate transaction');
            } else {
                $payment = new Payment();
                $payment->user_id = $newOrder->user_id;
                $payment->order_id = $newOrder->id;
                $payment->amount = $amount;
                $payment->currency = $newOrder->order_currency;
                $payment->description = 'Payment for Order ' . $newOrder->order_number;
                $payment->payment_ref = $paymentDetails['data']['id'];
                $payment->save();
                DB::commit();

                $admin = User::where('is_admin', 1)->get();
                $user = $newOrder->shipping_email;

                \Cart::session(auth()->check() ? auth()->id() : 'guest')->clear();
                request()->session()->forget('order');
                request()->session()->forget('session');

                AdminOrderNotification::dispatch($newOrder, $admin);
                SendOrderInvoice::dispatch($newOrder, $user)->delay(now()->addMinutes(3));

                return redirect()->route('checkout.success', ['reference' => $newOrder->order_reference]);;
            }
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
        $cart = \Cart::session(auth()->check() ? auth()->id() : 'guest')->getContent();
        $x = [];
        foreach ($cart as $key => $value) {
            $x[] = array($value['id'], $value['price'], $value['quantity'], $value['attributes']['size']);
        }
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $subamount = \Cart::session(auth()->check() ? auth()->id() : 'guest')->getSubTotal();
        $amount = \Cart::session(auth()->check() ? auth()->id() : 'guest')->getTotal();
        $order = $request->session()->get('order');
        $method = 'stripe';
        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Order from 2611 AUR',
                    ],
                    'unit_amount' => $amount * 100,
                ],
                'quantity' => 1,
            ]],
            'payment_intent_data' => [
                'metadata' => [
                    'order' => $order,
                    'subamount' => $subamount,
                    'user_id' => auth()->id() ?? rand(0000, 9999),
                    'order_items' => json_encode($x),
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.failure'),
        ]);
        \Cart::session(auth()->check() ? auth()->id() : 'guest')->clear();
        $request->session()->forget('order');
        return redirect()->away($checkout_session->url);
    }

    // //Handle Stripe Webhook
    // public function webhook(Request $request)
    // {
    //     try {
    //         $data = $request->all();
    //         $method = "stripe";
    //         $metadata = $data['data']['object']['metadata'];
    //         $user_id = $metadata['user_id'];
    //         switch ($data['type']) {
    //             case 'charge.succeeded':
    //                 $subamount = $metadata['subamount'];
    //                 $amount = $data['data']['object']['amount'] / 100;
    //                 $payment_id = $data['data']['object']['id'];
    //                 $order_items = $metadata['order_items'];
    //                 $res = (new OrderActions())->store(json_decode($metadata['order']), $amount, $subamount, $user_id, $method, json_decode($metadata['order_items']));
    //                 $newOrder = (new OrderQueries())->findByRef($res);
    //                 if ($newOrder) {
    //                     DB::beginTransaction();
    //                     if (PaymentRecord::where('payment_ref', $payment_id)->first()) {
    //                         throw new Exception('Payment Already made!');
    //                     }
    //                     $payment = new PaymentRecord();
    //                     $payment->user_id = auth()->id() ?? $newOrder->user_id;
    //                     $payment->order_id = $newOrder->id;
    //                     $payment->amount = $amount;
    //                     $payment->description = 'Payment for Order ' . $newOrder->order_number;
    //                     $payment->payment_ref = $payment_id;
    //                     $payment->save();
    //                     DB::commit();
    //                 }
    //                 $user = $newOrder->shipping_email;
    //                 $admin = User::where('is_admin', 1)->get();
    //                 NotifyAdminOrder::dispatch($newOrder, $admin);
    //                 SendOrderInvoice::dispatch($newOrder, $user)->delay(now()->addMinutes(3));
    //                 return 'webhook captured!';
    //                 break;
    //             default:
    //                 return 'webhook event not found';
    //         }
    //     } catch (Exception $e) {
    //         return $e;
    //     }
    // }












    public function checkoutSuccessful($ref){
        $order = OrderQueries::findByRef($ref);
        $currency = Currency::where('code',$order->order_currency)->first();
        if($order){
            return view('shop.order-success', compact('order','currency'));
        }else{
            abort(404);
        }

    }
}
