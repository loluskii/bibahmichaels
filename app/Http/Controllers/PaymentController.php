<?php

namespace App\Http\Controllers;

use Paystack;
use App\Models\Order;
use App\Helpers\Helper;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Actions\OrderActions;
use App\Services\OrderQueries;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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
            $amount = Helper::currency_converter(Cart::session(Helper::getSessionID())->getTotal());
            $email = $order->shipping_email;
            $request->merge(['metadata'=>$order,'reference'=>$reference, 'currency'=>$currency,'amount'=>$amount,'email'=>$email]);
            return $this->paystackRedirectToGateway($request);
        }
        else if($request->payment_method == "flutterwave"){
            $order = $request->session()->get('order');
            $reference = Flutterwave::generateReference();
            $amount = Helper::currency_converter(\Cart::session(Helper::getSessionID())->getTotal());
            $email = $order->shipping_email;
            $request->merge(['metadata'=>$order,'reference'=>$reference, 'currency'=>$currency,'amount'=>$amount,'email'=>$email]);
            return $this->flutterInit($request);
        }
    }

    public function flutterInit(Request $request)
    {
        try {
            $data = [
                'payment_options' => 'card,banktransfer',
                'amount' => $request->amount,
                'email' => Auth::user()->email ?? $request->email,
                'tx_ref' => Flutterwave::generateReference(),
                'currency' => $request->currency,
                'redirect_url' => route('flutter.callback'),
                'customer' => [
                    'email' => Auth::user()->email ?? $request->email,
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
        $status = request()->status;
        $order = session()->get('order');
        $currency = session('currency_code');
        if ($status != "cancelled") {
            $transactionID = Flutterwave::getTransactionIDFromCallback();
        }
        $amount = \Cart::session(Helper::getSessionID())->getTotal();
        $subamount = \Cart::session(Helper::getSessionID())->getSubTotal();
        $method = 'flutterwave';
        $user_id = auth()->check() ? auth()->id() : rand(0000, 9999);

        //if payment is successful
        if ($status == "cancelled") {
            return redirect()->route("checkout.page-3", ['session', session()->get('session')])->with("error", "Transaction Cancelled");
        } elseif ($status == 'successful') {
            $data = Flutterwave::verifyTransaction($transactionID);
            $res = OrderActions::store($order, $amount, $subamount, $user_id, $method, $currency);
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
                $payment->payment_ref = $transactionID;
                $payment->save();
                DB::commit();

                // $admin = User::where('is_admin', 1)->get();
                // $user = $newOrder->shipping_email;

                \Cart::session(auth()->check() ? auth()->id() : 'guest')->clear();
                request()->session()->forget('order');
                request()->session()->forget('session');

                // NotifyAdminOrder::dispatch($newOrder, $admin);
                // SendOrderInvoice::dispatch($newOrder, $user)->delay(now()->addMinutes(3));

                return redirect()->route('checkout.success', ['reference' => $newOrder->order_reference]);;
            }
        } else {
            return 'an error occurred';
        }
        // Get the transaction from your DB using the transaction reference (txref)
        // Check if you have previously given value for the transaction. If you have, redirect to your successpage else, continue
        // Confirm that the currency on your db transaction is equal to the returned currency
        // Confirm that the db transaction amount is equal to the returned amount
        // Update the db transaction record (including parameters that didn't exist before the transaction is completed. for audit purpose)
        // Give value for the transaction
        // Update the transaction to note that you have given value for the transaction
        // You can also redirect to your success page from here

    }


    public function paystackRedirectToGateway(Request $request)
    {
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    public function checkoutSuccessful($ref){
        $order = OrderQueries::findByRef($ref);
        if($order){
            return view('shop.order-success', compact('order'));
        }else{
            abort(404);
        }

    }
}
