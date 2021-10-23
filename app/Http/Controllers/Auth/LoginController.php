<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers , ThrottlesLogins;
   // protected $maxAttempts = 1;
    protected function username()
    {
        return 'email';
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');

    }

    public function login(Request $request)
    {
        $this->validatForm($request);
        if ($this->hasTooManyLoginAttempts($request)) {
          /*  $this->fireLockoutEvent($request);*/

            return $this->sendLockoutResponse($request);
        }

        if ( $this->userLoginAttemp($request)){
            return $this->sendLoginResponse();
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse();
       // $user = Auth::login();

    }

    protected function sendLoginResponse()
    {
        session()->regenerate();
        return redirect()->intended();
    }

    protected function sendFailedLoginResponse()
    {
        return back()->with('wrongCredentials',true);
    }

    private function userLoginAttemp(Request $request)
    {
        return Auth::attempt($request->only('email','password'),$request->filled('remember'));
    }

    public function logout(Request $request)
    {

        session()->invalidate();

        Auth::logout();

        return redirect()->route('home');
    }

    private function validatForm(Request $request)
    {
        return $request->validate([
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required'],
        ]);
    }
}
