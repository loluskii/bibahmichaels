<?php

namespace App\Http\Controllers;

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
}
