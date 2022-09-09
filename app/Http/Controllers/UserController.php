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
}
