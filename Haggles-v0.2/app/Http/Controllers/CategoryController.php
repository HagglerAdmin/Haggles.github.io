<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class CategoryController extends Controller
{
    public function count()
    {
        $category = Category::where('category_count','>',0)->get();

        return response()->json(['category' => $category]);        
    }

    public function name() 
    {
        $category = Category::select('id','category_name')->get();
        
        return response()->json(['category' => $category]);
    }

    public function show($id)
    {   
        $id = str_replace('-',' ', $id);

        $product = (new \App\Repositories\Categories)->search('category-product',$id,'null');

        return view('category.category', compact('product'));
    }

    public function fullTextSearch ( Request $request) 
    {

        $key = $request->input('keyword');
        $cat = $request->input('category');

        $input = '%'.$key.'%';
        
        $product = Product::join('products_photos','products_photos.product_id','=','products.id')
                
        ->join('products_remarks','products_remarks.product_id','=','products.id')

        ->join('product_stocks','product_stocks.product_id','=','products.id')

        ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
        'products.product_sale_price','products.created_at','products_photos.product_id','products_photos.product_photo',
        'products_photos.photo_type','products_remarks.product_status','products_remarks.avail_promo','product_stocks.stock_quantity',
        'product_stocks.stock_status')

        ->where(['products_photos.photo_type' => 'display', 'products_remarks.product_status' => 'Approve', 'products.product_category' => $cat])

        ->Where('products.product_tags','like', $input)

        ->latest()

        ->get();
        
        return view('category.category-product')->with('product', $product)->render();
    }

    public function filter (Request $request, $category) 
    {   
        $sort_by = $request->get('sort_by');
        $max_price = $request->get('max_price');
        $min_price = $request->get('min_price');
        $located_at = $request->get('located_at');

        if ( $request->filled(['sort_by', 'max_price', 'min_price', 'located_at']) )
        {
             $product = (new \App\Repositories\FilterCategory)->all($category, $sort_by, $max_price, $min_price, $located_at);
        }
        else if ( $request->filled(['sort_by', 'max_price', 'located_at']) )
        {
            return 'min_price wala';
        }
        else if ( $request->filled(['sort_by', 'min_price', 'located_at']) )
        {
            return 'max_price wala';
        }
        else if ( $request->filled(['sort_by', 'located_at']) )
        {
            return 'max_price min_price wala';
        }

        return view('category.category')->with('product', $product);
    }
}
