<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;  
use Illuminate\Support\Facades\Auth;
use App\Notifications\TwoFactorCode;
use Illuminate\Support\Facades\Notification;
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo ;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (Auth::check() && Auth::user()->role->id == 1) {
            $this->redirectTo = route('admin.dashboard');
        }else {
            $this->redirectTo = route('author.dashboard');
        }
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated(Request $request, $user)
    {
        try {
            $user->generateTwoFactorCode();
            $user->notify(new TwoFactorCode());    
        } catch (\Throwable $th) {
            return $th;
        }
    }
}

