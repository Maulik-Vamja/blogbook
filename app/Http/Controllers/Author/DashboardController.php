<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Followship;
use App\Tag;
use App\Ads_post;
use App\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        try {
            $user = Auth::user();
            $posts = $user->posts;
            $populer_posts = $user->posts()
                            ->withCount('comments')
                            ->withCount('favourite_to_users')
                            ->orderBy('view_count','desc')
                            ->orderBy('comments_count')
                            ->orderBy('favourite_to_users_count')
                            ->approved()
                            ->take(5)->get();
            $total_pending_posts = $posts->where('is_approved',false)->count();
            $all_view = $posts->sum('view_count');
            $followers = Followship::where('user1_id',$user->id)->count();
            $following = Followship::where('user2_id',$user->id)->count();
            $tag = Tag::where('user_id',$user->id)->count();
            $ads_post = Ads_post::where('author_id',auth()->user()->id)->count();
            return view('author.dashboard',compact('posts','populer_posts','total_pending_posts','all_view','followers','following','tag','ads_post'));
        } catch (\Throwable $th) {
            return $th;
        }
        
    }
}
