<?php

namespace App\Http\Controllers;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $posts = Post::latest()->approved()->published()->paginate(6);
        return view('all_posts',compact('posts','categories'));
    }
    public function details($slug)
    {
        try {
            $posts = Post::where('slug',$slug)->first();
            $categories = Category::all();
            $blogKey = 'Blog_'.$posts->id;
            if(!Session::has($blogKey))
            {
                $posts->increment('view_count');
                Session::put($blogKey,1);
            }
            $random = Post::approved()->published()->take(3)->inRandomOrder()->get();
            return view('post',compact('posts','random','categories'));
        } catch (\Throwable $th) {
            return $th;
        }
        
    }
    public function postByCategory($slug)
    {
        try {
            $category = Category::where('slug',$slug)->first();
            $posts = $category->posts()->approved()->published()->paginate(6);
            return view('postByCategory',compact('category','posts'));
        } catch (\Throwable $th) {
            return "Error";
        }
        
    }
    public function postByTag($slug)
    {
        try {
            $tag = Tag::where('slug',$slug)->first();
            $posts = $tag->posts()->approved()->published()->paginate(6);
            return view('postByTag',compact('tag','posts'));
        } catch (\Throwable $th) {
            return "Error";
        }
        
    }
}