<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
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
        $category = Category::latest()->get();
        return view('admin.category.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:categories',
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);

        try {
            //get image
        
        $slug = str_slug($request->name);
        $image= $request->file('image');
        if (isset($image)) {
            
            //unique name of image saving
            $currentdate = Carbon::now()->toDateString();
            $imagename = $slug .'-'.$currentdate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //check Directory is Exists Or Not..
            if(!Storage::disk('public')->exists('category')){
                Storage::disk('public')->makeDirectory('category');
            }

            // Resize Image for Single Category page.
            $size= Image::make($image)->resize(1600,479)->stream();
            Storage::disk('public')->put('category/'.$imagename,$size);

            // Check Category Folder for image is exists or not

            if(!Storage::disk('public')->exists('category/slider')){
                Storage::disk('public')->makeDirectory('category/slider');
            }

            // Resize Image for Category slider
            $size_slider= Image::make($image)->resize(500,333)->stream();
            Storage::disk('public')->put('category/slider/'.$imagename,$size_slider);
        }
        else {
            $imagename = 'default.png';
        }

        // Code For Image
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug ;
        $category->image = $imagename;
        $category->save();

        return redirect(route('admin.category.index'))->with('succesMsg','Your Category Is Inserted Succesfully..😊');
        } catch (\Throwable $th) {
            return "Error";
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request,[
            'name' => 'required'
        ]);
    try {
            //get image
        $image = $request->file('image');
        $slug = str_slug($request->name);

        $cat_data = Category::find($id);

        if (isset($image)) {
            
            //unique name of image saving
            $currentdate = Carbon::now()->toDateString();
            $imagename = $slug . '-'.$currentdate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //check Directory is Exists Or Not..
            if (!Storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }

            //delete Old Image

            if(Storage::disk('public')->exists('category/'.$cat_data->image))
            {
                Storage::disk('public')->delete('category/'.$cat_data->image);
            }

            //image resize for category page and uploade.
            $size = Image::make($image)->resize(1600,497)->stream();
            Storage::disk('public')->put('category/'.$imagename,$size);

            //check Directory for Slider is Exists Or Not..
            if (!Storage::disk('public')->exists('category/slider')) {
                Storage::disk('public')->makeDirectory('category/slider');
            }

            //delete An old Image for Slider

            if(Storage::disk('public')->exists('category/slider/'.$cat_data->image))
            {
                Storage::disk('public')->delete('category/slider/'.$cat_data->image);
            }

            //image resize for category slider and uploade.
            $slider_size = Image::make($image)->resize(500,333)->stream();
            Storage::disk('public')->put('category/slider/'.$imagename,$slider_size);
        }
        else {
            $imagename = $cat_data->image;
        }

        // Code For Image
        
        $cat_data->name = $request->name;
        $cat_data->slug = $slug ;
        $cat_data->image = $imagename;
        $cat_data->save();
        return redirect(route('admin.category.index'))->with('succesMsg','Your Category Is Updated Succesfully..😊');
    } catch (\Throwable $th) {
            return "Error";
    }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $cat_data = Category::findOrFail($id);
        if(Storage::disk('public')->exists('category/'.$cat_data->image))
        {
            Storage::disk('public')->delete('category/'.$cat_data->image);
        }
        if(Storage::disk('public')->exists('category/slider/'.$cat_data->image))
        {
            Storage::disk('public')->delete('category/slider/'.$cat_data->image);
        }
        $cat_data->delete();
        return redirect(route('admin.category.index'))->with('succesMsg','Your Category Is Deleted Succesfully..😊');
    }
}
