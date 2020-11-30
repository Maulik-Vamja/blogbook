<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Socialite;
use Auth;
use Exception;

class SocialController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback()
    {
        try 
        {
            $googleUser= Socialite::driver('google')->user();
            
            $exitUser=User::where('email',$googleUser->email)->first();
            if($exitUser)
            {
                Auth::loginUsingId($exitUser->id,true);
            }else{
                $user = new User;
                $user->name=$googleUser->name;
                $user->username = str_slug($googleUser->name);
                $user->email=$googleUser->email;
                $user->social_id=$googleUser->id;
                $user->image=$googleUser->image;
                $user->password=rand(1,10000);
                $user->save();
                Auth::loginUsingId($user->id,true);
            }
            return redirect(route('mainhome'));
        } catch (\Throwable $th) {
            return 'Error';
        }
        
    }
    public function redirectToFB()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function callbackToFB()
    {
        try 
        {
            $fbUser= Socialite::driver('facebook')->user();
            
            $exitUser=User::where('email',$fbUser->email)->first();
            if($exitUser)
            {
                Auth::loginUsingId($exitUser->id,true);
            }else{
                $user = new User;
                $user->name=$fbUser->name;
                $user->username = str_slug($fbUser->name);
                $user->email=$fbUser->email;
                $user->social_id=$fbUser->id;
               
                $user->password=rand(1,10000);
                $user->save();
                Auth::loginUsingId($user->id,true);
            }
            return redirect(route('mainhome'));
        } catch (\Throwable $th) {
            return $th;
        }
        
    }
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }
    public function callbackToTwitter()
    {
        try 
        {
            $twitterUser= Socialite::driver('twitter')->user();
            
            $exitUser=User::where('email',$twitterUser->email)->first();
            if($exitUser)
            {
                Auth::loginUsingId($exitUser->id,true);
            }else{
                $user = new User;
                $user->name=$twitterUser->name;
                $user->username = str_slug($twitterUser->name);
                // $user->email=$twitterUser->email;
                $user->social_id=$twitterUser->id;
                $user->password=rand(1,10000);
                $user->save();
                Auth::loginUsingId($user->id,true);
            }
            return redirect(route('mainhome'));
        } catch (\Throwable $th) {
            return $th;
        }
        
    }
}
