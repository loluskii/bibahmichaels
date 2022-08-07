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
        $attributes = [];
        foreach($request->except('_token','quantity') as $key => $value){
            $attributes[$key] = $value;
        }
        // dd(Helper::currency_converter($product->price));

        if($request->has('buy_now')){
            \Cart::session(Helper::getSessionID())->clear();
            \Cart::session(Helper::getSessionID())->add(array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'attributes' => $attributes,
                'associatedModel' => $product
            ));
            if(session()->has('session') == false){
                session()->put('session',session_create_id());
            }
            return redirect()->route('checkout.page-1',['session'=> session('session')]);
        }

        \Cart::session(Helper::getSessionID())->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'attributes' => $attributes,
            'associatedModel' => $product
        ));
        return redirect()->route('shop.product.show',['slug' => $product->slug]);
    }

    public function update($id){
        \Cart::session(Helper::getSessionID())->update($id,[
            'quantity' =>  array(
                'relative' => false,
                'value' => request('quantity'),
            )
        ]);

        return back();
    }

    public function destroy($id)
    {
        $cartItems = \Cart::session(Helper::getSessionID())->remove($id);

        return back();
    }


}
