<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showForgetForm()
    {
        return view('auth.passwords.forget-password');
    }

    public function sendResetLink(Request $request)
    {
       // dd($request->all());
        //validate
        $this->validateForm($request);

        //create Link
        //send Link
       $response = Password::broker()->sendResetLink($request->only('email'));
       \Log::info(($response === Password::RESET_LINK_SENT));
       if ($response === Password::RESET_LINK_SENT){
            return back()->with('resetLinkSent',true);
       }

        //redirect
        return back()->with('resetLinkFailed',true);
    }

    protected function validateForm($request)
    {
        $request->validate([
           'email' => ['required','email','exists:users']
        ]);
    }
}
