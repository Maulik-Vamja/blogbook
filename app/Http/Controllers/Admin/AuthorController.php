<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class AuthorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        try {
            $user = User::authors()
                    ->withCount('posts')
                    ->withCount('favourite_posts')
                    ->withCount('comments')
                    ->get();
        return view('admin.all_author',compact('user'));
        } catch (\Throwable $th) {
            return $th;
        }
        
    }
    public function destroy($id)
    {
        $author = User::findorFail($id)->delete();
        return redirect(route('admin.author.index'))->with('succesMsg','Author Deleted SuccesFully...😊');
    }
}
