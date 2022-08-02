<?php

namespace App\Http\Controllers;

use Paystack;
use App\Models\Order;
use App\Helpers\Helper;
use Illuminate\Http\Request;

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
            'value' => '50',
        ));
        \Cart::session(Helper::getSessionID())->condition($condition);
        $conditionValue = $condition->getValue();
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
        if($request->payment_method == "paystack"){
            $order = $request->session()->get('order');
            $reference = Paystack::genTranxRef();
            $currency = "NGN";
            $amount = \Cart::session(Helper::getSessionID())->getTotal() ;
            $email = $order->shipping_email;
            $request->merge(['metadata'=>$order,'reference'=>$reference, 'currency'=>$currency,'amount'=>$amount,'email'=>$email]);
            return $this->paystackRedirectToGateway($request);
        }
    }


    public function paystackRedirectToGateway(Request $request)
    {
        // dd($request->all());
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return $e->getMessage();
        }
    }
}
