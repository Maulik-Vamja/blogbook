<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ads_offer;
use Carbon\Carbon;

class AdsOfferController extends Controller
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
        $offer = Ads_Offer :: latest()->get();
        return view('admin.ads.index',compact('offer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ads.create');
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
            'title' => 'required',
            'price' => 'required|integer',
            'time' => 'required',
            'month' => 'required'
        ],[
            'price.integer' => 'The price value Must be between 0-9',
            'time.required' => 'Select Offer time Month or Year',
            'month.required' => 'Must Select Month for Offer Expirey time'            
        ]);
        try {

            $offer = new Ads_offer();
            $offer->title = $request->title;
            $offer->price = $request->price;
            if($request->time == false)
            {
                $offer->time = false;
            }
            else {
                $offer->time = true;
            }
            $offer->expire = Carbon::now()->addMonths($request->month);
            $offer->save();
            return redirect(route('admin.ads.index'))->with('succesMsg','Your Offer Is Inserted SuccesFully..😊');

        } catch (\Throwable $th) {
            return $th;
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
        $offer = Ads_offer::find($id);
        return view('admin.ads.edit',compact('offer'));
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
            'title' => 'required',
            'price' => 'required|integer',
            'time' => 'required'
        ],[
            'price.integer' => 'The price value Must be between 0-9',
            'time.required' => 'Select Offer time Month or Year'
        ]);

        try {
            $offer =Ads_offer ::find($id);
            $offer->title = $request->title;
            $offer->price = $request->price;
            if($request->time == false)
            {
                $offer->time = false;
            }
            else {
                $offer->time = true;
            }
            $offer->save();
            return redirect(route('admin.ads.index'))->with('succesMsg','Your Offer Is Updated SuccesFully..😊');

        } catch (\Throwable $th) {
            return $th;
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
        $offer = Ads_offer::findOrFail($id);
        $offer->delete();
        return redirect(route('admin.ads.index'))->with('succesMsg','Your Offer Is Deleted SuccesFully..😊');
    }
}
