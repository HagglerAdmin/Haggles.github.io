<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Deal;
use App\Product;
use Auth;
use Mail;

class trackingController extends Controller
{
    public function show ()
    {
        $code = request()->route('code');

        $track = Deal::join('orders','orders.id','=','deals.order_id')

        ->join('billings','billings.users_id','orders.user_id')

        ->join('products','products.id','=','deals.product_id')

        ->where(['deals.tracking_number' => $code, 'deals.user_id' => auth::id()])->get();
        
        return view('tracking.tracking', compact('track'));
    }

    public function sendEmail ()
    {   

        $user = User::find(Auth::id())->billing;
        $deal = Deal::where('user_id', Auth::id())->first();
        $product = Product::find($deal->product_id);
        $seller = User::find($product->user_id);

        $data = array('email' => $user->billing_email , 'id' => Auth::id(), 'status' => $deal->deal_remarks , 'track_num' => $deal->tracking_number, 
        'prod_id' => $product->id, 'user_name' => $seller->name, 'user_id' => $seller->id);
		
		Mail::send('emails.thanks',
		['data' => $data], 
		function ($message) use ($data) {
		    $message->from('penpen09280@gmail.com', 'Haggles');
		    $message->to($data['email'])->subject('Email Verification - Haggle');
        });
        
        return 'finish';
    }
}
