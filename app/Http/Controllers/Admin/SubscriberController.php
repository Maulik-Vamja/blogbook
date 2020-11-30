<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subscriber;

class SubscriberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $subscriber = Subscriber::latest()->get();
        return view('admin.subscriber.index',compact('subscriber'));
    }
    public function destroy($id)
    {
        $subscriber = Subscriber::findorFail($id);
        $subscriber->delete();
        return redirect(route('admin.subscriber.index'))->with('succesMsg','Subscriber Deleted SuccesFully...😊');
    }
}
