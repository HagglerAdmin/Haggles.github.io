<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ProductPosition;
use App\ProductGroup;
use App\Product;
use App\Order;
use Auth;

class StoreController extends Controller
{   
    public function show() 
    {  
        $product = (new \App\Repositories\Products)->show();

        $groups = ProductGroup::where('user_id', Auth::id())->get();
        
        return view('store.store', compact('product','groups'));
    }

    public function Order ()
    {   
        $orders = Order::join('products','products.id','=','orders.product_id')
        
        ->join('users','users.id','=','orders.user_id')

        ->select('orders.*','products.product_name','users.name')

        ->where(['products.user_id' => Auth::id()])

        ->latest()

        ->get();

        return view('store.orders', compact('orders'));
    }

    public function changePos (Request $request)
    {
        $ids = $request->input('ids');

        $validate = ProductPosition::where('user_id', Auth::id())->count();

        if ($validate <= 0)
        {
            ProductPosition::create([
                'user_id' => Auth::id(),
                'position' => json_encode($ids)
            ]);
        }
        else {
            ProductPosition::where('user_id', Auth::id())->update([
                'position' => json_encode($ids)
            ]);
        }
        return 'Position Change';
    }

    public function searchCategory(Request $request) 
    {
        if ( $request->input('request') != "all")  {

            $product = (new \App\Repositories\Categories)->search('category', $request->input('request'), '0');
        }
        else {
            
            $product = (new \App\Repositories\Products)->show();
        }

        return view('store.store-table')->with('product', $product)->render();
    }

    public function searchName(Request $request) 
    {    
     
        $product = (new \App\Repositories\Products)->search('tag', $request->input('tag'));

        return view('store.store-table')->with('product', $product)->render();
    }

    public function pagination () 
    {   
        $product = (new \App\Repositories\Products)->show();

        return view('store.store-table')->with('product', $product)->render();
    }

    public function modalEdit (Request $request)
    {
        $product = Product::find($request->input('id'));

        return response()->json(['product' => $product]);        
    }

    public function bargain (Request $request)
    {   

        $validate = Product::find($request->input('id'))->bargain()->count();

        if ($validate <= 0)
        {
            if ( $request->input('type') === 'bargain') {
                
                Product::find($request->input('id'))->bargain()->create([
                    'bargain_type' => 'Bargain',
                    'user_id' => Auth::id(),
                ]);
                    
                return 'thank you for bargaining';
            }
            else {
                
                Product::find($request->input('id'))->bargain()->create([
                    'bargain_type' => 'Auction',
                    'user_id' => Auth::id(),
                ]);
    
                return 'thank you for auctioning';
            }
        }
        else {
            return 'you already in bargain or auction';
        }
    }

    public function cloneProduct (Request $request)
    {   
        $product = Product::find($request->input('id'));
        
        return response()->json(['product' => $product]);
    }

    public function createGroup (Request $req)
    {
        $group =  json_encode($req->input('array'));
        
        ProductGroup::create([
            'user_id' => Auth::id(),
            'group_name' => $req->input('name'),
            'group_content' => $group
        ]);

        return 'Group Created';
    }
}