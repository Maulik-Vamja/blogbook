<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ads_post;
use App\Ads_offer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AdsPostController extends Controller
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
        $posts = Ads_post::where('author_id',auth()->user()->id)->latest()->get();
        return view('author.ads.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $offer = Ads_offer::all();
        return view('author.ads.create',compact('offer'));
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
            'adsoffer' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png',
            'link' => 'required|url',
            'month' => 'required'
        ],[
            'adsoffer.required' => 'Must have to select one offer before Submit',
            'link.required' => 'The link url must be http or https.',
            'link.url' => 'The link url must be http or https. And valid Formats.',
            'month.required' => 'You must have to select Month for the Expire date'
        ]);
        try {
            $image = $request->file('image');
            if(isset($image))
            {
                $currentDate = Carbon::now()->toDateString();
                $imagename = auth()->user()->username.'-ads-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                if(!Storage::disk('public')->exists('ads'))
                {
                    Storage::disk('public')->makeDirectory('ads');
                }
                $size = Image::make($image)->resize(281.27,273.91)->stream();
                Storage::disk('public')->put('ads/'.$imagename,$size);
            }else{
                $imagename = "default.png";
            }
            $amount = $request->total;
            $pay_id = uniqid().(string)auth()->user()->id;
            $post = new Ads_post();
            $post->pay_id = $pay_id;
            $post->author_id = auth()->user()->id;
            $post->offer_id = $request->adsoffer;
            $post->image = $imagename;
            $post->link = $request->link;
            $post->expire_time = Carbon:: now()->addMonth($request->month);
            $post->trans_id = '';
            $post->trans_status = false;
            $post->total_price = $amount;
            $post->save();

            $data_for_request = $this->handlePaytmRequest($pay_id,$amount);

            $paytm_txn_url = 'https://securegw-stage.paytm.in/theia/processTransaction';
            $paramList = $data_for_request['paramList'];
            $checkSum = $data_for_request['checkSum'];

            return view( 'paytm-merchant-form', compact( 'paytm_txn_url', 'paramList', 'checkSum' ) );

        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function handlePaytmRequest( $pay_id, $amount ) {
		// Load all functions of encdec_paytm.php and config-paytm.php
		$this->getAllEncdecFunc();
		$this->getConfigPaytmSettings();

        $checkSum = "";
        $paramList = array();

		// Create an array having all required parameters for creating checksum.
		$paramList["MID"] = 'iQaaIj75798318356030';
		$paramList["ORDER_ID"] = $pay_id;
		$paramList["CUST_ID"] = $pay_id;
		$paramList["INDUSTRY_TYPE_ID"] = 'Retail';
		$paramList["CHANNEL_ID"] = 'WEB';
		$paramList["TXN_AMOUNT"] = $amount;
		$paramList["WEBSITE"] = 'WEBSTAGING';
		$paramList["CALLBACK_URL"] = url('/paytm-callback');
		$paytm_merchant_key = 'mX6PrZvuFT6PuheQ';

		//Here checksum string will return by getChecksumFromArray() function.
		$checkSum = getChecksumFromArray( $paramList,$paytm_merchant_key);

		return array(
			'checkSum' => $checkSum,
			'paramList' => $paramList
		);
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
        $offer = Ads_offer::all();
        $post = Ads_post::find($id);
        return view('author.ads.edit',compact('post','offer'));
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
            'image' => 'mimes:jpeg,jpg,png',
            'link' => 'required',
        ],[
        ]);
        try {
            $post = Ads_post::find($id);
            $image = $request->file('image');
            if(isset($image))
            {
                $currentDate = Carbon::now()->toDateString();
                $imagename = auth()->user()->username.'-ads-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                if(!Storage::disk('public')->exists('ads'))
                {
                    Storage::disk('public')->makeDirectory('ads');
                }
            
                if(Storage::disk('public')->exists('ads/'.$post->image))
                {
                    Storage::disk('public')->delete('ads/'.$post->image);
                }
                $size = Image::make($image)->resize(1600,1066)->stream();
                Storage::disk('public')->put('ads/'.$imagename,$size);
            }
            else {
                $imagename = $post->image;
            }
            $amount = $post->total_price;
            $post->author_id = auth()->user()->id;
            if(isset($request->adsoffer)){
                $post->offer_id = $request->adsoffer;
            }
            $post->image = $imagename;
            $post->link = $request->link;
            $post->expire_time = Carbon:: now()->addMonth($request->month);
            $post->trans_id = '';
            $post->total_price = $amount;
            $post->save();

            return redirect(route('author.ads.index'))->with('succesMsg','Your Post is SuccesFully Updated..😊');

        } catch (\Throwable $th) {
            throw $th;
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
        $post = Ads_post::find($id);
        if(Storage::disk('public')->exists('ads/'.$post->image))
        {
            Storage::disk('public')->delete('ads/'.$post->image);
        }
        $post->delete();
        return redirect(route('author.ads.index'))->with('succesMsg','Your Advertisment Post Is Deleted Succesfully..😊');
    }

    /**
	 * Get all the functions from encdec_paytm.php
	 */
	function getAllEncdecFunc() {
		function encrypt_e($input, $ky) {
            $key   = html_entity_decode($ky);
            $iv = "@@@@&&&&####$$$$";
            $data = openssl_encrypt ( $input , "AES-128-CBC" , $key, 0, $iv );
            return $data;
        }
        
        function decrypt_e($crypt, $ky) {
            $key   = html_entity_decode($ky);
            $iv = "@@@@&&&&####$$$$";
            $data = openssl_decrypt ( $crypt , "AES-128-CBC" , $key, 0, $iv );
            return $data;
        }
        
        function generateSalt_e($length) {
            $random = "";
            srand((double) microtime() * 1000000);
        
            $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
            $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
            $data .= "0FGH45OP89";
        
            for ($i = 0; $i < $length; $i++) {
                $random .= substr($data, (rand() % (strlen($data))), 1);
            }
        
            return $random;
        }
        
        function checkString_e($value) {
            if ($value == 'null')
                $value = '';
            return $value;
        }
        
        function getChecksumFromArray($arrayList, $key, $sort=1) {
            if ($sort != 0) {
                ksort($arrayList);
            }
            $str = getArray2Str($arrayList);
            $salt = generateSalt_e(4);
            $finalString = $str . "|" . $salt;
            $hash = hash("sha256", $finalString);
            $hashString = $hash . $salt;
            $checksum = encrypt_e($hashString, $key);
            return $checksum;
        }
        function getChecksumFromString($str, $key) {
            
            $salt = generateSalt_e(4);
            $finalString = $str . "|" . $salt;
            $hash = hash("sha256", $finalString);
            $hashString = $hash . $salt;
            $checksum = encrypt_e($hashString, $key);
            return $checksum;
        }
        
        function verifychecksum_e($arrayList, $key, $checksumvalue) {
            $arrayList = removeCheckSumParam($arrayList);
            ksort($arrayList);
            $str = getArray2StrForVerify($arrayList);
            $paytm_hash = decrypt_e($checksumvalue, $key);
            $salt = substr($paytm_hash, -4);
        
            $finalString = $str . "|" . $salt;
        
            $website_hash = hash("sha256", $finalString);
            $website_hash .= $salt;
        
            $validFlag = "FALSE";
            if ($website_hash == $paytm_hash) {
                $validFlag = "TRUE";
            } else {
                $validFlag = "FALSE";
            }
            return $validFlag;
        }
        
        function verifychecksum_eFromStr($str, $key, $checksumvalue) {
            $paytm_hash = decrypt_e($checksumvalue, $key);
            $salt = substr($paytm_hash, -4);
        
            $finalString = $str . "|" . $salt;
        
            $website_hash = hash("sha256", $finalString);
            $website_hash .= $salt;
        
            $validFlag = "FALSE";
            if ($website_hash == $paytm_hash) {
                $validFlag = "TRUE";
            } else {
                $validFlag = "FALSE";
            }
            return $validFlag;
        }
        
        function getArray2Str($arrayList) {
            $findme   = 'REFUND';
            $findmepipe = '|';
            $paramStr = "";
            $flag = 1;	
            foreach ($arrayList as $key => $value) {
                $pos = strpos($value, $findme);
                $pospipe = strpos($value, $findmepipe);
                if ($pos !== false || $pospipe !== false) 
                {
                    continue;
                }
                
                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= "|" . checkString_e($value);
                }
            }
            return $paramStr;
        }
        
        function getArray2StrForVerify($arrayList) {
            $paramStr = "";
            $flag = 1;
            foreach ($arrayList as $key => $value) {
                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= "|" . checkString_e($value);
                }
            }
            return $paramStr;
        }
        
        function redirect2PG($paramList, $key) {
            $hashString = getchecksumFromArray($paramList);
            $checksum = encrypt_e($hashString, $key);
        }
        
        function removeCheckSumParam($arrayList) {
            if (isset($arrayList["CHECKSUMHASH"])) {
                unset($arrayList["CHECKSUMHASH"]);
            }
            return $arrayList;
        }
        
        function getTxnStatus($requestParamList) {
            return callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
        }
        
        function getTxnStatusNew($requestParamList) {
            return callNewAPI(PAYTM_STATUS_QUERY_NEW_URL, $requestParamList);
        }
        
        function initiateTxnRefund($requestParamList) {
            $CHECKSUM = getRefundChecksumFromArray($requestParamList,PAYTM_MERCHANT_KEY,0);
            $requestParamList["CHECKSUM"] = $CHECKSUM;
            return callAPI(PAYTM_REFUND_URL, $requestParamList);
        }
        
        function callAPI($apiURL, $requestParamList) {
            $jsonResponse = "";
            $responseParamList = array();
            $JsonData =json_encode($requestParamList);
            $postData = 'JsonData='.urlencode($JsonData);
            $ch = curl_init($apiURL);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);                                                                  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                         
            'Content-Type: application/json', 
            'Content-Length: ' . strlen($postData))                                                                       
            );  
            $jsonResponse = curl_exec($ch);   
            $responseParamList = json_decode($jsonResponse,true);
            return $responseParamList;
        }
        
        function callNewAPI($apiURL, $requestParamList) {
            $jsonResponse = "";
            $responseParamList = array();
            $JsonData =json_encode($requestParamList);
            $postData = 'JsonData='.urlencode($JsonData);
            $ch = curl_init($apiURL);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);                                                                  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                         
            'Content-Type: application/json', 
            'Content-Length: ' . strlen($postData))                                                                       
            );  
            $jsonResponse = curl_exec($ch);   
            $responseParamList = json_decode($jsonResponse,true);
            return $responseParamList;
        }
        function getRefundChecksumFromArray($arrayList, $key, $sort=1) {
            if ($sort != 0) {
                ksort($arrayList);
            }
            $str = getRefundArray2Str($arrayList);
            $salt = generateSalt_e(4);
            $finalString = $str . "|" . $salt;
            $hash = hash("sha256", $finalString);
            $hashString = $hash . $salt;
            $checksum = encrypt_e($hashString, $key);
            return $checksum;
        }
        function getRefundArray2Str($arrayList) {	
            $findmepipe = '|';
            $paramStr = "";
            $flag = 1;	
            foreach ($arrayList as $key => $value) {		
                $pospipe = strpos($value, $findmepipe);
                if ($pospipe !== false) 
                {
                    continue;
                }
                
                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= "|" . checkString_e($value);
                }
            }
            return $paramStr;
        }
        function callRefundAPI($refundApiURL, $requestParamList) {
            $jsonResponse = "";
            $responseParamList = array();
            $JsonData =json_encode($requestParamList);
            $postData = 'JsonData='.urlencode($JsonData);
            $ch = curl_init($apiURL);	
            curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_URL, $refundApiURL);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  
            $jsonResponse = curl_exec($ch);   
            $responseParamList = json_decode($jsonResponse,true);
            return $responseParamList;
        }
        
	}

	/**
	 * Config Paytm Settings from config_paytm.php file of paytm kit
	 */
	function getConfigPaytmSettings() {
		define('PAYTM_ENVIRONMENT', 'TEST'); // PROD
        define('PAYTM_MERCHANT_KEY', 'mX6PrZvuFT6PuheQ'); //Change this constant's value with Merchant key received from Paytm.
        define('PAYTM_MERCHANT_MID', 'iQaaIj75798318356030'); //Change this constant's value with MID (Merchant ID) received from Paytm.
        define('PAYTM_MERCHANT_WEBSITE', 'WEBSTAGING'); //Change this constant's value with Website name received from Paytm.

        $PAYTM_STATUS_QUERY_NEW_URL='https://securegw-stage.paytm.in/merchant-status/getTxnStatus';
        $PAYTM_TXN_URL='https://securegw-stage.paytm.in/theia/processTransaction';
        if (PAYTM_ENVIRONMENT == 'PROD') {
            $PAYTM_STATUS_QUERY_NEW_URL='https://securegw.paytm.in/merchant-status/getTxnStatus';
            $PAYTM_TXN_URL='https://securegw.paytm.in/theia/processTransaction';
        }

        define('PAYTM_REFUND_URL', '');
        define('PAYTM_STATUS_QUERY_URL', $PAYTM_STATUS_QUERY_NEW_URL);
        define('PAYTM_STATUS_QUERY_NEW_URL', $PAYTM_STATUS_QUERY_NEW_URL);
        define('PAYTM_TXN_URL', $PAYTM_TXN_URL);
	}

	public function paytmCallback( Request $request ) {
		$pay_id = $request['ORDERID'];

		if ( 'TXN_SUCCESS' === $request['STATUS'] ) {
			$transaction_id = $request['TXNID'];
			$post = Ads_post::where('pay_id',$pay_id)->first();
			$post->trans_id = $transaction_id;
			$post->trans_status = true;
			$post->save();
			return redirect(route('author.ads.index'))->with('succesMsg','Your Payment is SuccesFully Recieved And Post is SuccesFully Inserted..😊');
		} else if( 'TXN_FAILURE' === $request['STATUS'] ){
			return redirect(route('author.ads.index'))->with('ErrorMsg','Your Payment is Not SuccesFully Recieved Duu to some Reason. Make Payment after some time.');
		}
    }
    
    public function payNOw($id)
    {
        $post = Ads_post::find($id);
        $data_for_request = $this->handlePaytmRequest($post->pay_id,$post->total_price);

            $paytm_txn_url = 'https://securegw-stage.paytm.in/theia/processTransaction';
            $paramList = $data_for_request['paramList'];
            $checkSum = $data_for_request['checkSum'];

            return view( 'paytm-merchant-form', compact( 'paytm_txn_url', 'paramList', 'checkSum' ) );
    }
}
