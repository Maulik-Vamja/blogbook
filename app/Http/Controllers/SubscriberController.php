<?php

namespace App\Http\Controllers;
use App\Subscriber;

use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        try {
            $this->validate($request,[
                'email' => 'required|email|unique:subscribers'
            ]);
    
            $subscriber = new Subscriber();
            $subscriber->email = $request->email;
            $subscriber->save();
    
            return redirect()->back()->with('succesMsg','Thank you for Subscribe..😊😊');
        } catch (\Throwable $th) {
            return "Error";
        }
        
    }
}
