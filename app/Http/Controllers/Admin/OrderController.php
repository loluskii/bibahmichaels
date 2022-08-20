<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Custom;
use Illuminate\Http\Request;
use App\Actions\OrderActions;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        $pending = Order::where('status',1)->get();
        return view('admin.sales.orders.index', compact('orders','pending'));
    }

    public function show($id)
    {
        $order = Order::where('order_reference',$id)->first();
        return view('admin.sales.orders.show', compact('order'));
    }

    public function update(Request $request, $id)
    {
        try {
            if($request->status == 2){
                $newOrder = Order::findOrFail($id);
                $user = $newOrder->shipping_email;
                $res = OrderActions::update($request, $id);
                if($res){
                    // SendOrderInvoice::dispatch($newOrder, $user)->delay(now()->addSecond());
                    return back()->with('success','Successful!');
                }
            }else if($request->status == 4){
                $order = Order::findOrFail($id);
                $user = $order->shipping_email;
                $res = OrderActions::update($request, $id);
                if($res){
                    // UserOrderShipped::dispatch($order, $user)->delay(now()->addSecond());
                    return back()->with('success','Successful!');
                }
            }else if($request->status == 5){
                $order = Order::findOrFail($id);
                $user = $order->shipping_email;
                $res = OrderActions::update($request, $id);
                if($res){
                    try {
                        // UserOrderDelivered::dispatch($order, $user)->delay(now()->addSecond());
                        return back()->with('success','Successful!');
                    } catch (\Exception $e) {
                        return back()->with('error',$e->getMessage());
                    }
                }
            }else{
                $res = OrderActions::update($request, $id);
                if($res){
                    return back()->with('success','Successful!');
                }else{
                    return back()->with('error','An error occured');
                }
            }
        } catch (\Exception $e) {
            return back()->with('error',$e->getMEssage());
        }
    }

    public function customOrders()
    {
        // return true;
        $orders = Custom::all();
        return view('admin.sales.custom.index', compact('orders'));
    }

    public function viewCustom($id)
    {
        $order = Custom::findOrFail($id);
        return view('admin.sales.custom.show', compact('order'));
    }
}
