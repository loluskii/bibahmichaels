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
    public static function store($order, $amount, $subamount, $user_id = null, $method, $currency, $cart = null){
        $newOrder = new Order();
        $ref = Str::random(20);
        $newOrder->user_id = $user_id;
        $newOrder->order_number = uniqid('#');
        $newOrder->order_reference = $ref;
        $newOrder->status = 1;
        $newOrder->subtotal = floatval($subamount) * $currency->exchange_rate;
        $newOrder->grand_total = $amount;
        $newOrder->order_currency = $currency->code;
        $newOrder->is_paid = 1;

        if($method == "flutterwave"){
            $newOrder->item_count = \Cart::session(Helper::getSessionID())->getContent()->count();
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
            $cartItems =  \Cart::session(Helper::getSessionID())->getContent();
            $newOrder->save();

            foreach($cartItems as $item){
                $newOrder->items()->attach($item->id, ['price'=> $item->price*$currency->exchange_rate, 'quantity'=> $item->quantity, 'size'=>$item->attributes->size, 'color'=>$item->attributes->color]);
            }
        }else if($method == "paystack"){
            $newOrder->item_count = count($cart);
            $newOrder->payment_method = $method;
            $newOrder->shipping_email = $order['shipping_email'];
            $newOrder->shipping_fname = $order['shipping_fname'];
            $newOrder->shipping_lname = $order['shipping_lname'];
            $newOrder->shipping_address = $order['shipping_address'];
            $newOrder->shipping_city = $order['shipping_city'];
            $newOrder->shipping_state = $order['shipping_state'];
            $newOrder->shipping_phone = $order['shipping_phone'];
            $newOrder->shipping_postal_code = $order['shipping_postal_code'] ?? '098809';
            $newOrder->shipping_country = $order['shipping_country'];
            $newOrder->save();

            foreach($cart as $key => $item){
                $newOrder->items()->attach($item['id'], ['price'=> floatval($item['price'])*$currency->exchange_rate, 'quantity'=> $item['quantity'], 'size'=>$item['attributes']['size'] ?? 'None', 'color'=>$item['attributes']['color'] ?? 'None']);
            }
        }





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
