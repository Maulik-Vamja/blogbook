<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;   
use Illuminate\Http\Request;
use App\Category;
use App\Tag;
use App\Subscriber;
use Carbon\Carbon;
use App\Notifications\AuthorPostApproved;
use App\Notifications\NewpostNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
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
        $posts = Post::latest()->get();
        return view('admin.post.index',compact('posts'));
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
        return view('admin.post.create',compact('category','tag'));
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
                return redirect()->back()->with('contentMsg','You Cant add a disturbing content..i.e sex,pornography,ass etc.');
            }
            else{
            try {
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
                $post->is_approved = true;
                $post->save();
                $post->categories()->attach($request->categories);
                $post->tags()->attach($request->tags);
                $subscribers = Subscriber::all();
                foreach ($subscribers as $subscriber) {
                    Notification::route('mail',$subscriber->email)->notify(new NewpostNotification($post));
                }
            } catch (\Throwable $th) {
                return $th;
            }
                return redirect(route('admin.post.index'))->with('succesMsg','Your Post Is Inserted Succesfully..😊');
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
        return view('admin.post.show',compact('post'));
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
        return view('admin.post.edit',compact('post','category','tag'));
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
                return redirect()->back()->with('contentMsg','You Cant add a disturbing content..i.e.  sex,porn etc.');
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
                $post->is_approved = true;
                $post->save();
                $post->categories()->sync($request->categories);
                $post->tags()->sync($request->tags);

                return redirect(route('admin.post.index'))->with('succesMsg','Your Post Is Updated Succesfully..😊');
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
        try {
            if(Storage::disk('public')->exists('posts/'.$post->image))
        {
            Storage::disk('public')->delete('posts/'.$post->image);
        }
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();

        return redirect(route('admin.post.index'))->with('succesMsg','Your Post Is Deleted Succesfully..😊');
        } catch (\Throwable $th) {
            return "Error";
        }
        
    }

    public function pending()
    {
        $posts = Post::where('is_approved',false)->get();
        return view('admin.post.pending',compact('posts'));
    }
    public function approval($id)
    {
        $post = Post::find($id);
        $post->is_approved = true;
        $post->save();
        $post->user->notify(new AuthorPostApproved($post));
        return redirect()->back()->with('succesMsg','Your Post Is Approved..😊');
    }
    

}





