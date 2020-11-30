<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    { 
        $posts = Auth::user()->posts;
        return view('author.comment',compact('posts'));
    }
    public function destroy($id)
    {
        Comment::findOrFail($id)->delete();
        return redirect()->back()->with('succesMsg','Comment Deleted SuccesFully..👍');
    }
}
