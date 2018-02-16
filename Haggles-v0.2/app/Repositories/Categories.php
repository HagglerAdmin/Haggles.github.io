<?php

namespace App\Repositories;

use App\Category;
use App\User;
use App\Product;
use Auth;

class Categories {

    public function mostUsed ()
    {   
        return Category::select('category_name','category_count')->orderBy('category_count','desc')->get();
    }

    public function fetch ($type) 
    {
        switch ($type) 
        {
            case 'name':

                return Category::select('category_name')->get();
            
            break;
        }
    }

    public function search ($type, $value, $id)
    {
        switch ($type)
        {
            case 'category':

                return User::find(auth::id())->product()
                
                ->join('products_photos','products_photos.product_id','=','products.id')
        
                ->join('products_remarks','products_remarks.product_id','=','products.id')
        
                ->join('product_stocks','product_stocks.product_id','=','products.id')
        
                ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
                'products.product_sale_price','products.created_at','products_photos.product_id','products_photos.product_photo',
                'products_photos.photo_type','products_remarks.product_status','products_remarks.avail_promo','product_stocks.stock_quantity',
                'product_stocks.stock_status')

                ->where(['products_photos.photo_type' => 'display', 'products.product_category' => $value])
        
                ->latest()
        
                ->paginate(10);

            break;

            case 'haggler-category':

                return User::find($id)->product()
                
                ->join('products_photos','products_photos.product_id','=','products.id')
        
                ->join('products_remarks','products_remarks.product_id','=','products.id')
        
                ->join('product_stocks','product_stocks.product_id','=','products.id')
        
                ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
                'products.product_sale_price','products.created_at','products_photos.product_id','products_photos.product_photo',
                'products_photos.photo_type','products_remarks.product_status','products_remarks.avail_promo','product_stocks.stock_quantity',
                'product_stocks.stock_status')

                ->where(['products_photos.photo_type' => 'display', 'products.product_category' => $value, 'products_remarks.product_status' => 'Approve'])
        
                ->latest()
        
                ->paginate(10);
                
            break;

            case 'category-product':
            
                return Product::join('products_photos','products_photos.product_id','=','products.id')
        
                ->join('products_remarks','products_remarks.product_id','=','products.id')
        
                ->join('product_stocks','product_stocks.product_id','=','products.id')
        
                ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
                'products.product_sale_price','products.created_at','products_photos.product_id','products_photos.product_photo',
                'products_photos.photo_type','products_remarks.product_status','products_remarks.avail_promo','product_stocks.stock_quantity',
                'product_stocks.stock_status')

                ->where(['products_photos.photo_type' => 'display', 'products.product_category' => $value, 'products_remarks.product_status' => 'Approve'])
        
                ->latest()
        
                ->paginate(10);
                
            break;
            
            case 'search-category':

                $input = '%'.$value.'%';
            
                return Product::join('products_photos','products_photos.product_id','=','products.id')

                ->join('products_remarks','products_remarks.product_id','=','products.id')

                ->join('product_stocks','product_stocks.product_id','=','products.id')

                ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
                'products.product_sale_price','products.created_at','products_photos.product_id','products_photos.product_photo',
                'products_photos.photo_type','products_remarks.product_status','products_remarks.avail_promo','product_stocks.stock_quantity',
                'product_stocks.stock_status')

                ->where(['products_photos.photo_type' => 'display','products_remarks.product_status' => 'Approve', 
                'products.product_category' => $id])

                ->where('products.product_tags','Like', $input)

                ->latest()

                ->paginate(10);
                
            break;
        }
    }
}