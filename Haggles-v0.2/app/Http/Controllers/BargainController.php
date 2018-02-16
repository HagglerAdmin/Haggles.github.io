<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\BargainDeal;
use App\Product;
use App\Bargain;
use App\BargainsConversation;
use App\Order;
use Auth;
use Image;

class BargainController extends Controller
{
    public function list() 
    {   

        $lists =  Bargain::join('products','products.id','=','bargains.product_id')
        
        ->join('products_photos','products_photos.product_id','=','products.id')

        ->join('products_remarks','products_remarks.product_id','=','products.id')

        ->selectRaw('bargains.id,bargains.bargain_type, products.product_name, products_photos.product_photo,products.product_regular_price')
                
        ->groupBy('bargains.id','bargains.bargain_type','products.product_name', 'products_photos.product_photo','product_regular_price')

        ->orderBy('id')

        ->where(['products_photos.photo_type' => 'Display', 'products_remarks.product_status' => 'Approve'])
        
        ->get();

        return view('bargain.bargain-list', compact('lists'));
    }

    public function searchList(Request $request) 
    {
        $input = '%'.$request->input('keyword').'%';
        
        $lists =  Bargain::join('products','products.id','=','bargains.product_id')
        
        ->join('products_photos','products_photos.product_id','=','products.id')

        ->join('products_remarks','products_remarks.product_id','=','products.id')

        ->selectRaw('bargains.id, products.product_name, products_photos.product_photo,products.product_regular_price')
                
        ->groupBy('bargains.id','products.product_name', 'products_photos.product_photo','product_regular_price')

        ->orderBy('id')

        ->where(['products_photos.photo_type' => 'Display', 'products_remarks.product_status' => 'Approve'])
        
        ->where('products.product_tags','Like',$input)
        
        ->get();

        return view('bargain.list')->with('lists', $lists)->render();
    }

    public function modalDeal(Request $request)
    {
        return $deal = BargainsConversation::join('users','users.id', '=', 'bargains_conversations.users_id')

        ->join('users_photos','users_photos.user_id', '=', 'bargains_conversations.users_id')

        ->join('users_profiles', 'users_profiles.user_id', '=', 'bargains_conversations.users_id')

        ->select('bargains_conversations.*', 'users_photos.user_photo', 'users.name', 'users_profiles.phone_number', 'users_profiles.email_address')

        ->where(['users_photos.photo_type' => 'display' , 'bargains_conversations.id' => $request->input('id')])

        ->get();
        
        return response()->json(['deal' => $deal]);
    }

    public function acceptDeal(Request $request) 
    {
        $id = $request->input('id');
        $bargain = BargainsConversation::find($id);

        $order = Order::create([
            'product_id' => $bargain->bargain->product_id,
            'user_id' => $bargain->users_id,
            'order_price' => $bargain->price_offer,
            'order_quantity' => $bargain->quantity_offer,
            'order_length' => $bargain->bargain->product->productdimension->product_length,
            'order_width' => $bargain->bargain->product->productdimension->product_width,
            'order_height' => $bargain->bargain->product->productdimension->product_height,
            'order_weight' => $bargain->bargain->product->productdimension->product_weight,
            'order_remarks' => 'Pending',
        ]);

        event(new BargainDeal($order, $request));
    }

    public function store(Request $request)
    {
        Bargain::find($request->input('id'))->convo()->create([
            'users_id' => Auth::id(),
            'convo_message' => $request->input('msg'),
            'convo_type' => $request->input('user'),
            'price_offer' => $request->input('price'),
            'quantity_offer' => $request->input('qty')
        ]);
        
        $product = Bargain::find($request->input('id'));

        if ($request->input('user') == "Seller" ) {

            return view('bargain.seller')->with('product', $product)->render();
        }
        else {

            return view('bargain.buyer')->with('product', $product)->render();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bargain $bargain)
    {  
        return view('bargain.bargain',['product' => $bargain]);
    }

    public function sample ()
    {
        return view('sample');
    }

    public function sample1 (Request $request)
    {   

        $image = $request['displayphotos'];
        $filename  = time() . '.' . $image->getClientOriginalExtension();

        $dimension = getimagesize($image);

        $path = public_path('photos/' . $filename);

        Image::make($image->getRealPath())->resize(800, 800)->save($path);
    }
}