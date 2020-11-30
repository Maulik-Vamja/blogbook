<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Followship;

class FollowshipController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function follow_index()
    {
        $followers = Followship::where('user1_id',auth()->user()->id)->where('user2_id','!=',auth()->user()->id)->get();
        return view('followers',compact('followers'));
    }
    public function following_index()
    {
        $following = Followship::where('user1_id',"!=",auth()->user()->id)->where('user2_id',auth()->user()->id)->get();
        return view('following',compact('following'));
    }
}
