<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ads_post;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AdsPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $posts = Ads_post::latest()->get();
        return view('admin.ads.post_index',compact('posts'));
    }
    public function destroy($id)
    {
        $post = Ads_post::find($id);
        if(Storage::disk('public')->exists('ads/'.$post->image))
        {
            Storage::disk('public')->delete('ads/'.$post->image);
        }
        $post->delete();
        return redirect(route('admin.adv_post.index'))->with('succesMsg','Your Advertisment Post Is Deleted Succesfully..😊');
    }
}
