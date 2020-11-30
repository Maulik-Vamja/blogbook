<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $comments = Comment::latest()->get();
        return view('admin.comment',compact('comments'));
    }
    public function destroy($id)
    {
        Comment::findOrFail($id)->delete();
        return redirect()->back()->with('succesMsg','Comment Deleted SuccesFully..👍');
    }
}

