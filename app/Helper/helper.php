<?php

function IsFollowing($id)
{
    if(\App\Followship::where('user1_id',$id)->where('user2_id',auth()->user()->id)->exists())
    {
        return "following";
    }
    elseif(\App\Followship::where('user1_id',auth()->user()->id)->where('user2_id',$id)->exists()) {
        return "follow back";
    }
    else{
        return "follow";
    }

}
