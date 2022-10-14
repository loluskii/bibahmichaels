<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Auth::user()->orders;
        $addresses = Auth::user()->addresses();
        $default = Auth::user()->getDefaultAddress();

        return view('user.index', compact('addresses','default','orders'));
    }

    public function show($ref){
        $order = Order::firstWhere('order_reference', $ref);
        return view('user.show', compact('order'));
    }

    public function edit(Request $request){
        try {
            $address = Address::where('user_id',auth()->id())->get();
            $address->shipping_fname  = $request->shipping_fname;
            $address->shipping_lname =  $request->shipping_lname;
            $address->shipping_address =  $request->shipping_address;
            $address->shipping_country = $request->shipping_country;
            $address->shipping_city = $request->shipping_city;
            $address->shipping_state = $request->shipping_state;
            $address->shipping_zipcode = $request->shipping_postal_code;
            $address->shipping_phone = $request->shipping_phone;
            $address->save();

            return response()->json(['success' => true ] );
        } catch (\Exception $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
