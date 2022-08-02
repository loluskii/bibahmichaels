<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function getSessionID(){
        if(!Auth::check()){
            return 'guest';
        }
        return auth()->id();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::take(8)->get();
        return view('welcome', compact('products'));
    }

    public function viewShop()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('shop.index', compact('products','categories'));
    }

    public function viewProduct($id)
    {
        $product = Product::where('slug',$id)->first();
        $group = $product->attributes->groupBy('attribute_name');
        $similar = Product::where('id','!=',$product->id)
                            ->where('category_id',$product->category_id)
                            ->take(4)
                            ->get();
        return view('shop.product-detail', compact('product', 'similar','group'));
    }

    public function viewCart(){
        $cartTotalQuantity = \Cart::session(Helper::getSessionID())->getContent()->count();
        $cartItems = \Cart::session(Helper::getSessionID())->getContent();
        return view('shop.cart', compact('cartItems', 'cartTotalQuantity'));
    }

    public function bridalOrder(Request $request){
        dd($request->all());
    }

    public function bespokeOrder(Request $request)
    {
        dd('');
    }








}
