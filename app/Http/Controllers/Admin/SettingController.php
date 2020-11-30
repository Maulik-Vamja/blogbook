<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.profile');
    }
    public function updateProfile(Request $req)
    {
        
            $this->validate($req,[
                'name'=> 'required|string',
                'username' => 'string',
                'image'=>'mimes:jpeg,png,jpg',
                'about' => 'required|string',
            ]);
        try {
            $image = $req->image;
            $slug = str_slug($req->name);
            $user = User::findorFail(Auth::id());
            if(isset($image))
            {
                $currentDate = Carbon::now()->toDateString();
                $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
    
                if(!Storage::disk('public')->exists('profile'))
                {
                    Storage::disk('public')->makeDirectory('profile');
                }
    
                if(Storage::disk('public')->exists('profile/'.$user->image))
                {
                    Storage::disk('public')->delete('profile/'.$user->image);
                }
    
                $profileImage = Image::make($image)->resize(500,500)->stream();
                Storage::disk('public')->put('profile/'.$imagename,$profileImage);
            }
            else
            {
                $imagename = $user->image;
            }
    
            $user->name = $req->name;
            $user->username = $req->username;
            $user->image = $imagename;
            $user->about = $req->about;
            $user->save();
    
            return redirect()->back()->with('succesMsg','Profile Updated SuccesFully..😊');
        } catch (\Throwable $th) {
            return $th;
        }
        
    }

    public function password_index()
    {
        return view('admin.password_change');
    }

    public function password_update(Request $req)
    {
        $this->validate($req,[
            'old_password' => 'required',
            'password' =>'required|confirmed' 
        ]);

        try {
            $userPassword = Auth::user()->password;
        if(Hash::check($req->old_password,$userPassword))
        {
            if(!Hash::check($req->password,$userPassword))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($req->password);
                $user->save();
                Auth::logout();
                return redirect()->back();
            }
            else{
                return redirect()->back()->with('ErrorMsg','❗❗..New Password Should Not Be Same with Your Current Password');
            }
        }
        else{
            return redirect()->back()->with('ErrorMsg','❗❗..Old Password Does Not same with Current Password');
        }
        } catch (\Throwable $th) {
            return $th;
        }
        
    }
}
