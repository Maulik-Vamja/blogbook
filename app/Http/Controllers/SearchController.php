<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class SearchController extends Controller
{
    public function postSearch(Request $request)
    {
        try {
            $title = $request->title;
            $data = Post::where('title','LIKE','%'.$title.'%')->approved()->published()->get();
            return view('postSearch',compact('data','title'));
        } catch (\Throwable $th) {
            return $th;
        }
        
    } 
    public function authorSearch(Request $request)
    {
        try {
            $name = $request->name;
            $data = User::where('name','LIKE','%'.$name.'%')->get();
            return view('authorSearch',compact('data','name'));
        } catch (\Throwable $th) {
            return "Error";
        }
        
    } 
}
