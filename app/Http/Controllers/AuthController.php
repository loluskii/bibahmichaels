<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function __construct()
    {

        $this->middleware('guest', ['except' => ['logout']]);

    }



    public function register(RegisterRequest $request)
    {
        try {
            \DB::beginTransaction();
            $user = User::create([
                'fname' => $request['fname'],
                'lname' => $request['lname'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
            Auth::login($user, true);
            $user->sendEmailVerificationNotification();
            \DB::commit();

            return redirect()->intended('/')->with(
                'success',
                'Welcome'
            );
        } catch (\Exception $e) {
            return back()->with(
                'error',
                'An Error Occured. Please try again later.'
            );
        }
    }

    public function login(Request $request)
    {
        try {
            if (Auth::check()) {
                return redirect()->route('admin.dashboard');
            }
            $input = $request->all();

            $request->validate([
                'email' => ['required'],
                'password' => ['required'],
            ]);

            $shouldRemember = $request->remember ? true : false;
            $cartItems = \Cart::session('guest')->getContent();
            \Cart::session('guest')->clear();
            if (Auth::attempt(array('email' => $input['email'], 'password' => $input['password']),  $shouldRemember)) {
                $request->session()->regenerate();
                $userId = auth()->user()->id; // or any string represents user identifier
                \Cart::session($userId)->add($cartItems);
                return redirect()->intended('/');
            }
            session()->flash('loginMsg', 'The provided credentials do not match our records.');
            return back();
        } catch (\Exception $e) {
            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        \Cart::session(Helper::getSessionID())->clear();
        return redirect('/')->with(
            'success',
            'Logged Out Successfully',
        );
    }
}
