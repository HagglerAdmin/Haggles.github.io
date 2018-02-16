<?php

namespace App\Http\Controllers;

use App\Events\Buying;
use App\Events\EditProduct;
use Illuminate\Http\Request;
use App\Events\NewProduct;
use Carbon\Carbon;
use App\Http\Requests\ValidateProduct;
use App\Product;
use App\User;
use Redirect;
use Auth;

class ProductController extends Controller
{   

    public function view () 
    {   

        $mostUsedCategory = (new \App\Repositories\Categories)->mostUsed();

        return view('store.add-product', compact('city','mostUsedCategory'));
    }

    public function index()
    {
        return (new \App\Repositories\Products)->all("Approve");
    }

    public function store(ValidateProduct $request)
    {
        $product = User::find(auth::id())->product()->create([
    		'product_name' => $request->input('product_name'),
    		'product_brand' => $request->input('product_brand'),
    		'product_category' => $request->input('product_category'),
    		'product_regular_price' => $request->input('product_regular_price'),
    		'product_sale_price' => $request->input('product_sale_price'),
    		'product_description' => $request->input('product_description'),
    		'product_short_desc' => $request->input('product_short_desc'),
			'product_date_sale' => $request->input('product_date_sale'),
			'product_exp_sale' => $request->input('product_exp_sale'),
            'product_tags' => $request->input('product_name') .",". $request->input('product_brand') .",". $request->input('product_category'),
            'product_location' => $request->input('product_location')
    	]);

        event(new NewProduct($product, $request));

        session()->flash('message', 'You added a new product');

        return Redirect::back();
    }

    public function editFunction(ValidateProduct $request) {

        User::find(auth::id())->product()

            ->where('id', $request->input('product_id'))

            ->update([
                'product_name' => $request->input('product_name'),
                'product_brand' => $request->input('product_brand'),
                'product_category' => $request->input('product_category'),
                'product_regular_price' => $request->input('product_regular_price'),
                'product_sale_price' => $request->input('product_sale_price'),
                'product_description' => $request->input('product_description'),
                'product_short_desc' => $request->input('product_short_desc'),
                'product_date_sale' => $request->input('product_date_sale'),
                'product_exp_sale' => $request->input('product_exp_sale'),
                'product_tags' => $request->input('product_name') .",". $request->input('product_brand'),
        ]);

        event(new EditProduct($request));

        session()->flash('message', 'Your product has been Edited');

        return Redirect::back();
    }


    public function show(Product $product)
    {      
        return view('store.edit-product', compact('product'));
    }

    public function inMarket($id,$slug) 
    {  
        $product = Product::find($id);

        $product_id = $product->id;

        $owner = $product->user_id;

        $user_id = Auth::id();

        $today = Carbon::today()->toDateString();

        $views = (new \App\Repositories\Products)->countView( $product_id, $user_id);

        $view = (new \App\Repositories\Products)->validateView( $product_id, $user_id);
        
        if ( count($views) <= 0 )
        {   
            Product::find($product_id)->view()->create(['user_id' => $owner, 'viewer_id' => $user_id]);

            return view('product.product')->with('product', $product);
        }
        else if ( count($views) > 0 )  
        {   
            foreach ($view as $key => $value)   
            {    
                if (  $today != Carbon::parse($value->created_at)->toDateString()) 
                {
                    Product::find($product_id)->view()->create(['user_id' => $owner, 'viewer_id' => $user_id]);

                    return view('product.product')->with('product', $product);
                }
                else
                {
                    return view('product.product')->with('product', $product);
                }
            }
        }
    }

    public function buyer(Request $request)
    {
        $id = $request->input('id');
        $product = Product::find($id);
        $date = Carbon::today()->addDay(3);

        $order = User::find(Auth::id())->order()->create([
            'product_id' => $id,
            'order_price' => $request->input('offer_price'),
            'order_quantity' => $request->input('qty'),
            'order_length' => $product->productdimension->product_length,
            'order_width' => $product->productdimension->product_width,
            'order_height' => $product->productdimension->product_height,
            'order_weight' => $product->productdimension->product_weight,
            'order_remarks' => "Pending",
            'mode_of_payment' => "Null",
            'order_exp' => $date,
        ]);

        event(new Buying($request, $order));

        return 'Thank you for buying';
    }
}