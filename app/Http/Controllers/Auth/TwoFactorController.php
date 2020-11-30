<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\TwoFactorCode;
use App\Notifications\UserClientInfo;
use Illuminate\Support\Facades\Notification;
use App\Helper\UserSystemInfoHelper;

class TwoFactorController extends Controller
{
    public function index() 
    {
        return view('auth.twoFactor');
    }

    public function store(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'integer|required',
        ]);

        $user = auth()->user();

        if($request->input('two_factor_code') == $user->two_factor_code)
        {
            $user->resetTwoFactorCode();
            $get_ip = UserSystemInfoHelper::get_ip();
            $browser = UserSystemInfoHelper::get_browsers();
            $device = UserSystemInfoHelper::get_device();
            $os = UserSystemInfoHelper::get_os();
            $user->notify(new UserClientInfo($get_ip,$browser,$device,$os));
            return redirect()->route('mainhome');
        }

        return redirect()->back()
            ->withErrors(['two_factor_code' => 'The two factor code you have entered does not match']);
    }

    public function resend()
    {
        $user = auth()->user();
        $user->generateTwoFactorCode();
        $user->notify(new TwoFactorCode());

        return redirect()->back()->withMessage('The two factor code has been sent again');
    }
}
