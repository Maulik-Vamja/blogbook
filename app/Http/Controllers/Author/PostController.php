<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Tag;
use Carbon\Carbon;
use App\User;
use App\Notifications\NewAuthorPost;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $posts = Auth::user()->posts()->latest()->get();
        return view('author.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $tag = Tag::all();
        return view('author.post.create',compact('category','tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        $validate = $this->validate($request,[
            'title'=>'required | min:2 | unique:posts',
            'image'=>'mimes:jpeg,jpg,png|required',
            'categories'=>'required',
            'tags'=>'required',
            'body'=>'required',
        ],[
            'title.required'=>'The Title Field Is Required.',
            'title.unique' => 'This Post Title is Already Taken.. Please Choose Another one.',
            'title.min'=>'Length of the Title Must be Greater Then 2.',
            'Image.required'=>'The Image Field Is Required.',
            'image.mimes'=>'The Image Must be a Type of JPEG,PNG,JPG.',
            'categories.required' => 'Atleast 1 Category should be Select.',
            'tags.required' => 'Atleast 1 Tag should be Select.',
            'body.required' => 'The Body Field Is Required.',
        ]);

        try 
        {
            $blacklistArray = array('ass','ball sack','sex','porn','pornography');
            $matches = array();
            $matchFound = preg_match_all(
                            "/\b(" . implode("|",$blacklistArray) . ")\b/i", 
                            $request->body, 
                            $matches
                        );
    
            // if it find matches bad words
    
            if ($matchFound) {
                $contain = true;
            }
            else{
                
                $contain = false;
            }

            $image = $request->file('image');
            $slug = str_slug($request->title);
            
            if(isset($image))
            {
                $currentDate = Carbon::now()->toDateString();
                $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                if(!Storage::disk('public')->exists('posts'))
                {
                    Storage::disk('public')->makeDirectory('posts');
                }
            
                $size = Image::make($image)->resize(1600,1066)->stream();
                Storage::disk('public')->put('posts/'.$imagename,$size);
            }
            else {
                $imagename = "default.png";
            }
            
            $post = new Post();
            $post->user_id = Auth::id();
            $post->title = $request->title;
            $post->slug = $slug;
            $post->image = $imagename;
            $post->body = $request->body;
            if(isset($request->status))
            {
                $post->status = true;
            }
            else {
                $post->status = false;
            }
            
            if ($contain == true){
                $post->is_approved = false;    
            }
            else{
                $post->is_approved = true;
            }

            
            $post->save();
            $post->categories()->attach($request->categories);
            $post->tags()->attach($request->tags);
            if($contain == true)
            {
                $users = User::where('role_id','1')->get();
                Notification::send($users,new NewAuthorPost($post));
                return redirect(route('author.post.index'))->with('succesMsg','Your Post Is Inserted Succesfully..But For Some Reason you need Approval for this Post. Our Team will inspect your Post Content and after you get Email From BlokBook Thank You...😊');
            }
            else{
                return redirect(route('author.post.index'))->with('succesMsg','Your Post is inserted SuccesFully..😊');
            }
            
        } catch (\Throwable $th) {
            return $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if($post->user_id != Auth::id())
        {
            return redirect()->back();
        }
        else{
            return view('author.post.show',compact('post'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $category = Category::all();
        $tag = Tag::all();
        return view('author.post.edit',compact('post','category','tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validate = $this->validate($request,[
            'title'=>'required | min:2',
            'image'=>'mimes:jpeg,jpg,png',
            'categories'=>'required',
            'tags'=>'required',
            'body'=>'required',
        ],[
            'title.required'=>'The Title Field Is Required.',
            'title.min'=>'Length of the Title Must be Greater Then 2.',
            'image.mimes'=>'The Image Must be a Type of JPEG,PNG,JPG.',
            'categories.required' => 'Atleast 1 Category should be Select.',
            'tags.required' => 'Atleast 1 Tag should be Select.',
            'body.required' => 'The Body Field Is Required.',
        ]);
        try {
            $blacklistArray = array('ass','ball sack','sex','porn','pornography');
        $matches = array();
        $matchFound = preg_match_all(
                        "/\b(" . implode("|",$blacklistArray) . ")\b/i", 
                        $request->body, 
                        $matches
                    );

        // if it find matches bad words

        if ($matchFound) {
            $contain = true;
        }
        else{
            $contain = false;
        }

        if ($contain == true){
            return redirect()->back()->with('contentMsg','Sorry..You Can Not Edit a Post with inappropriate content.Like...Sex,Porn,Pornography etc.');
        }
        else{
                $image = $request->file('image');
                $slug = str_slug($request->title);
                
                if(isset($image))
                {
                    $currentDate = Carbon::now()->toDateString();
                    $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                    if(!Storage::disk('public')->exists('posts'))
                    {
                        Storage::disk('public')->makeDirectory('posts');
                    }
                
                    if(Storage::disk('public')->exists('posts/'.$post->image))
                    {
                        Storage::disk('public')->delete('posts/'.$post->image);
                    }
                    $size = Image::make($image)->resize(1600,1066)->stream();
                    Storage::disk('public')->put('posts/'.$imagename,$size);
                }
                else {
                    $imagename = $post->image;
                }
                
                $post->user_id = Auth::id();
                $post->title = $request->title;
                $post->slug = $slug;
                $post->image = $imagename;
                $post->body = $request->body;
                if(isset($request->status))
                {
                    $post->status = true;
                }
                else {
                    $post->status = false;
                }
                $post->save();
                $post->categories()->sync($request->categories);
                $post->tags()->sync($request->tags);
        
                return redirect(route('author.post.index'))->with('succesMsg','Your Post Is Updated Succesfully..😊');
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Storage::disk('public')->exists('posts/'.$post->image))
        {
            Storage::disk('public')->delete('posts/'.$post->image);
        }
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
        return redirect(route('author.post.index'))->with('succesMsg','Your Post Is Deleted Succesfully..😊');
    }
}
