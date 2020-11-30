<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class CommentController extends Controller
{
    public function store($id,Request $request)
    {
        $this->validate($request,[
            'comment' => 'required'
        ]);
        try {
            $comment = new Comment();
            $comment->post_id = $id;
            $comment->user_id = Auth::id();
            $comment->comment = $request->comment;
            $comment->save();

            return redirect()->back()->with('commentMsg','Your Comment is Posted Successfully..😊 ');
        } catch (\Throwable $th) {
            return "Error";
        }

        
    }
}
