<?php
namespace App\Actions;

use Exception;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductActions
{
    public static function store($order, $amount, $subamount, $user_id = null, $method, $orderItems = null){
        $newOrder = new Order();
        $ref = Str::random(20);
        $newOrder->user_id =
        $newOrder->order_number = uniqid('#');
    }

    public static function update($request, $id){
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->update();
        return true;
    }

}
?>
