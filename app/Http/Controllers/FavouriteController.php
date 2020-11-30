<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function add($id)
    {
        $user = Auth::user();
        $isFavourite = $user->favourite_posts()->where('post_id',$id)->count();

        if($isFavourite == 0)
        {
            $user->favourite_posts()->attach($id);
            return redirect()->back();
        }else{
            $user->favourite_posts()->detach($id);
            return redirect()->back()->with('succesMsg','Your Favourite post Remove SuccesFully...😊');
        }
    }
}
