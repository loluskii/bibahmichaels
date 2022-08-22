<?php
namespace App\Actions;

use Exception;
use App\Models\Order;
use App\Helpers\Helper;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;

class OrderActions
{
    public static function store($order, $amount, $subamount, $user_id = null, $method, $currency, $orderItems = null){
        $newOrder = new Order();
        $ref = Str::random(20);
        $newOrder->user_id = $user_id;
        $newOrder->order_number = uniqid('#');
        $newOrder->order_reference = $ref;
        $newOrder->status = 1;
        $newOrder->subtotal = $subamount * session('currency_exchange_rate');
        $newOrder->grand_total = $amount * session('currency_exchange_rate');
        $newOrder->order_currency = $currency;
        if($method === "flutterwave"){
            $newOrder->item_count = \Cart::session(Helper::getSessionID())->getContent()->count();
        }
        $newOrder->is_paid = 1;
        $newOrder->payment_method = $method;
        $newOrder->shipping_email = $order->shipping_email;
        $newOrder->shipping_fname = $order->shipping_fname;
        $newOrder->shipping_lname = $order->shipping_lname;
        $newOrder->shipping_address = $order->shipping_address;
        $newOrder->shipping_city = $order->shipping_city;
        $newOrder->shipping_state = $order->shipping_state;
        $newOrder->shipping_phone = $order->shipping_phone;
        $newOrder->shipping_postal_code = $order->shipping_postal_code ?? '098809';
        $newOrder->shipping_country = $order->shipping_country;
        $newOrder->save();

        // if($method == "flutterwave"){
        //     $cartItems =  \Cart::session(auth()->check() ? auth()->id() : 'guest')->getContent();
        //     foreach($cartItems as $item){
        //         $newOrder->items()->attach($item->id, ['price'=> $item->price, 'quantity'=> $item->quantity, 'size'=>$item->attributes->size, 'color'=>$item->attributes->color]);
        //     }
        // }

        return $ref;
    }

    public static function update($request, $id){
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->update();
        return true;
    }

}
?>
