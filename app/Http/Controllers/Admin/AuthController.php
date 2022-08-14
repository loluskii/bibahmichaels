<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // public function __contruct(){
    //     return $this->middleware('');
    // }
    public function index(){
        return view('admin.auth.login');
    }

    public function authenticate(Request $request)
    {

        try{
            $input = $request->all();

            $request->validate([
                'email' => ['required'],
                'password' => ['required'],
            ]);

            $shouldRemember = $request->remember ? true : false;

            if (Auth::attempt(array('email' => $input['email'] , 'password' => $input['password'], 'is_admin' => 1 )) ) {
                $request->session()->regenerate();

                return redirect()->route('admin.dashboard')->with(
                    'success', 'Welcome Admin!',
                );
            }
            // session()->flash('loginMsg', 'The provided credentials do not match our records.');
            return back()->with('error', 'The provided credentials do not match our records.');
        }catch(\Exception $e){
            return back()->with(
                'error', $e->getMessage()
            );
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/admin')->with(
            'success',
            'Logged Out Successfully',
        );
    }

}
