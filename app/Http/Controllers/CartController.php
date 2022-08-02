<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Darryldecode\Cart\Cart;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        $product = Product::find($id);

        if($request->has('buy_now')){
            \Cart::session(Helper::getSessionID())->clear();
            \Cart::session(Helper::getSessionID())->add(array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'attributes' => array(
                    'size' => $request->size ?? '',
                    'color' => $request->color ?? '',
                ),
                'associatedModel' => $product
            ));
            $request->session()->put('session',session_create_id());
            // dd(session('session'));
            return redirect()->route('checkout.page-1',['session'=> session('session')]);
        }
        \Cart::session(Helper::getSessionID())->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'size' => $request->size ?? '',
                'color' => $request->color ?? '',
            ),
            'associatedModel' => $product
        ));
        return redirect()->route('shop.product.show',['slug' => $product->slug]);
    }


}
