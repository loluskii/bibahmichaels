<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Actions\UserActions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;

class ForgotPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendEmail(ForgotPasswordRequest $request){
        try{
            $user = User::where('email','=',$request->email);
            if($user){
                UserActions::forgotPasswordEmail($request);
                return back()->with('success','We have sent you a reset link. Check your email.');
            }else{
                session()->flash('message', "Oops! We can't seem to find your email. Please create an account.");
                return back();
            }
        }catch(\Exception $e){
            return back()->with(
                'error', $e->getMessage()
            );
        }
    }

    public function updatePassword(ResetPasswordRequest $request){
        try{
            $status = UserActions::setNewPassword($request);

            // dd($status);

            return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('success', __($status))
                    : back()->with(['error' => [__($status)]]);

        }catch(\Exception $e){
            return back()->with(
                'error', $e->getMessage()
            );
        }
    }
}
