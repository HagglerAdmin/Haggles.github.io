<?php 

namespace App\Repositories;

use App\Category;
use App\Product;

class FilterCategory 
{
    public function all ($category, $sort_by, $max_price, $min_price, $located_at) 
    {      
        
        if ( $sort_by == "All" && $located_at == "All" )
        {
            return Product::join('products_photos','products_photos.product_id','=','products.id')
            
            ->join('products_remarks','products_remarks.product_id','=','products.id')
    
            ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
                'products.product_sale_price','products.created_at','products_photos.product_id',
                'products_photos.product_photo','products_photos.photo_type','products_remarks.product_status')
            
            ->where(['products_photos.photo_type' => 'display','products_remarks.product_status' => 'Approve', 'products.product_category' => $category])

            ->whereRaw("products.product_regular_price >= $min_price AND products.product_regular_price <= $max_price")
            
            ->latest()
            
            ->get();
        }

        else if ( $sort_by == "All" )
        {
            return Product::join('products_photos','products_photos.product_id','=','products.id')
            
            ->join('products_remarks','products_remarks.product_id','=','products.id')
    
            ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
                'products.product_sale_price','products.created_at','products_photos.product_id',
                'products_photos.product_photo','products_photos.photo_type','products_remarks.product_status')
            
            ->where(['products_photos.photo_type' => 'display','products_remarks.product_status' => 'Approve', 'products.product_category' => $category, 'products.product_location' => $located_at])

            ->whereRaw("products.product_regular_price >= $min_price AND products.product_regular_price <= $max_price")
            
            ->latest()
            
            ->get();
        }

        else if ( $sort_by == "Popular" && $located_at == "All")
        {
            return Product::join('products_photos','products_photos.product_id','=','products.id')
            
            ->join('products_remarks','products_remarks.product_id','=','products.id')
            
            ->join('products_views','products_views.product_id','=','products.id')
            
            ->selectRaw('count(products_views.product_id) view, products.id, products.product_category, products.product_name,products.product_regular_price,products.product_sale_price,products.created_at,products_photos.product_id,products_photos.product_photo,products_photos.photo_type,products_remarks.product_status')
            
            ->where(['products_photos.photo_type' => 'display','products_remarks.product_status' => 'Approve', 'products.product_category' => $category])

            ->whereRaw("products.product_regular_price >= $min_price AND products.product_regular_price <= $max_price")
            
            ->groupBy('products.id','products.product_category','products.product_name','products.product_regular_price',
            'products.product_sale_price','products.created_at','products_photos.product_id',
            'products_photos.product_photo','products_photos.photo_type','products_remarks.product_status')

            ->orderByRaw('view desc')

            ->get();
        }

        else if ( $sort_by == "Featured" && $located_at == "All") 
        {
            return Product::join('products_photos','products_photos.product_id','=','products.id')
            
            ->join('products_remarks','products_remarks.product_id','=','products.id')
    
            ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
                'products.product_sale_price','products.created_at','products_photos.product_id',
                'products_photos.product_photo','products_photos.photo_type','products_remarks.product_status')
            
            ->where(['products_photos.photo_type' => 'display','products_remarks.product_status' => 'Approve', 
            'products_remarks.avail_promo' => 'Featured' ,'products.product_category' => $category])

            ->whereRaw("products.product_regular_price >= $min_price AND products.product_regular_price <= $max_price")
            
            ->latest()
            
            ->get();
        }

        else if ( $sort_by == "Recent" && $located_at == "All") 
        {
            return Product::join('products_photos','products_photos.product_id','=','products.id')
            
            ->join('products_remarks','products_remarks.product_id','=','products.id')
    
            ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
                'products.product_sale_price','products.created_at','products_photos.product_id',
                'products_photos.product_photo','products_photos.photo_type','products_remarks.product_status')
            
            ->where(['products_photos.photo_type' => 'display','products_remarks.product_status' => 'Approve', 'products.product_category' => $category])

            ->whereRaw("products.product_regular_price >= $min_price AND products.product_regular_price <= $max_price")
            
            ->latest()
            
            ->get();
        }

        else if ( $sort_by == "Oldest" && $located_at == "All")
        {
            return Product::join('products_photos','products_photos.product_id','=','products.id')
            
            ->join('products_remarks','products_remarks.product_id','=','products.id')
    
            ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
                'products.product_sale_price','products.created_at','products_photos.product_id',
                'products_photos.product_photo','products_photos.photo_type','products_remarks.product_status')
            
            ->where(['products_photos.photo_type' => 'display','products_remarks.product_status' => 'Approve', 'products.product_category' => $category])

            ->whereRaw("products.product_regular_price >= $min_price AND products.product_regular_price <= $max_price")
            
            ->oldest()
            
            ->get();
        }
        
    }
}