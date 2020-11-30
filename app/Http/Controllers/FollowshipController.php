<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Followship;

class FollowshipController extends Controller
{
    public function userAction(Request $request)
    {
        try {
            if($request->action == "unfollow")
            { 
                if(Followship::where('user1_id',"!=",auth()->user()->id)->where('user2_id',auth()->user()->id)->exists()){
                    $data = Followship::where('user1_id',$request->user_id)->where('user2_id',auth()->user()->id)->first();
                    $data->delete();
                    $data = Followship::where('user1_id',"!=",auth()->user()->id)->where('user2_id',auth()->user()->id)->get();
                    return response()->view('following_action',compact('data'));
                }else{
                    return response()->json(['data' => 'Sorry enable to Process.']);
                }
            }
            elseif ($request->action == "follow") {
                $data =new  Followship();
                $data->user1_id = $request->user_id;
                $data->user2_id = auth()->user()->id;
                $data->save();
                $data2 = Followship::where('user1_id',auth()->user()->id)->where('user2_id','!=',auth()->user()->id)->get();
                return response()->view('followers_action',compact('data2'));
            }
            elseif ($request->action == "reload-follower") {
                $data2 = Followship::where('user1_id',auth()->user()->id)->where('user2_id','!=',auth()->user()->id)->get();
                return response()->view('followers_action',compact('data2'));
            }
        } catch (\Throwable $th) {
            return "Error";
        }
        
    }
}
