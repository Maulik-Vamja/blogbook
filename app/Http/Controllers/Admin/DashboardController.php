<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Category;
use App\Tag;
use App\Followship;
use Carbon\Carbon;
use App\Ads_offer;
use App\Ads_post;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    try {
            $posts = Post::all();
        $popular_post = Post::withCount('comments')
                            ->withCount('favourite_to_users')
                            ->orderBy('view_count','desc')
                            ->orderBy('comments_count','desc')
                            ->orderBy('favourite_to_users_count','desc')
                            ->take(5)->get();
        $total_pending_post = Post::where('is_approved',false)->count();
        $all_view = Post::sum('view_count');
        $total_author = User::where('role_id',2)->count();
        $new_author_today = User::where('role_id',2)
                                ->whereDate('created_at',Carbon::today())->count();

        $active_authors = User::where('role_id',2)
                                ->withCount('posts')
                                ->withCount('comments')
                                ->withCount('favourite_posts')
                                ->orderBy('posts_count','desc')
                                ->orderBy('comments_count','desc')
                                ->orderBy('favourite_posts_count','desc')
                                ->take(10)->get();

        $categories = Category::all()->count();
        $tag = Tag::all()->count();
        $followers = Followship::where('user1_id',auth()->user()->id)->count();
        $following = Followship::where('user2_id',auth()->user()->id)->count();
        $offer = Ads_offer::all()->count();
        $ads_post = Ads_post::all()->count();
        return view('Admin.dashboard',compact('posts','popular_post','total_pending_post','all_view','total_author','new_author_today','active_authors','categories','tag','followers','following','offer','ads_post'));
    } catch (\Throwable $th) {
        return "Error";
    }
        
    }
}

