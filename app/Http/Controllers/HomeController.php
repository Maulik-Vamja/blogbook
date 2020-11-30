<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Tag;
use App\Post;
use App\Ads_post;
use App\User;
use Carbon\Carbon;
use App\Followship;
use App\Http\Controllers\Auth;
use App\Notifications\ContactUs;
use Illuminate\Support\Facades\Notification;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            if(auth()->check())
            {
                $posts=array();
                $following = Followship::where('user2_id',auth()->user()->id)->pluck('user1_id');
                foreach ($following as $user) {
                    $posts[] = Post::where('user_id',$user)->approved()->published()->latest()->get();
                }
                $posts = array_flatten($posts);
            }
            else{
                $posts=Post::latest()->approved()->published()->inRandomOrder()->take(6)->get();
            }
            $categories = Category::all();
            $ads_post = Ads_post::latest()->paid()->take(6)->get();
            return view('welcome',compact('posts','categories','ads_post'));
        } catch (\Throwable $th) {
            return $th;
        }
        
    }
    public function profile($username)
    {
        try {
        $user = User::where('username',$username)->first();
        $posts = $user->posts()->approved()->published()->get();
        $followers = Followship::where('user1_id',$user->id)->count();
        return view('profile',compact('user','followers','posts'));
        } catch (\Throwable $th) {
            return $th;
        }
        
    }


    public function popularAuthor()
    {
        try {
            $users = User::withCount('posts')
                    ->withCount('comments')
                    ->withCount('favourite_posts')
                    ->orderBy('posts_count','desc')
                    ->orderBy('comments_count','desc')
                    ->orderBy('favourite_posts_count','desc')
                    ->take(6)->get();
        return view('populer_author',compact('users'));
        } catch (\Throwable $th) {
            return "Error";
        }
        
    }
    public function contact_us()
    {
        $admin = User::where('role_id',1)->get();
        return view('contact_us',compact('admin'));
    }
    public function sendMail(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'min:10|max:10',
            'message' => 'required'
        ]);

        $admin = User::where('role_id',1)->get();
        Notification::send($admin,new ContactUs($request));

        return redirect()->back()->with('contactMsg','Your Request is Submitted Succesfully, We will be Contact you soon.');
    }
}
