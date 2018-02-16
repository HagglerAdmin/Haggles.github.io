<?php 

namespace App\Repositories;

use App\Product;
use App\User;
use App\Order;
use App\Notification;
use Carbon\Carbon;
use App\Deal;
use Auth;

class Products {

    public function productCategory ($category)
    {
        return Product::join('products_photos','products_photos.product_id','=','products.id')
        
        ->join('products_remarks','products_remarks.product_id','=','products.id')

        ->select('products.*','products_photos.product_photo')

        ->where(['products.product_category' => $category, 'products_photos.photo_type' => 'Display', 'products_remarks.product_status' => 'Approve'])

        ->limit(4)

        ->latest()

        ->get();
    }

    public function suggestedProduct ($category)
    {
        return Product::join('products_photos','products_photos.product_id','=','products.id')
        
        ->join('products_remarks','products_remarks.product_id','=','products.id')

        ->select('products.*','products_photos.product_photo')

        ->where(['products.product_category' => $category, 'products_photos.photo_type' => 'Display', 'products_remarks.product_status' => 'Approve'])

        ->limit(5)

        ->latest()

        ->get();
    }

    public function validateUrl($id)
    {
        $product = Product::where('id', $id)->get();
        
        foreach ($product as $key => $value) {

            return "p/".str_replace(' ','-', strtolower($value->product_name))."&id=".$value->id;
        
        }   
    }

    public function sales ()
    {
        return Product::join('orders','orders.product_id','=','products.id')
        
        ->select('orders.*','products.product_name')

        ->latest()

        ->where(['orders.order_remarks' => 'Complete', 'products.user_id' => Auth::id()])

        ->get();
    }

    public function categoryBought ()
    {
        return Order::join('products','products.id','=','orders.product_id')

        ->join('categories','categories.category_name','=','products.product_category')

        ->selectRaw('DISTINCT COUNT(orders.id) qty, categories.category_name, (categories.color_code) color')
        
        ->groupBy('orders.id','categories.category_name','categories.color_code')

        ->where(['orders.user_id' => Auth::id() ])

        ->get();
    }

    public function buyHistory ()
    {
        return Deal::join('delivery','delivery.deal_id','=','deals.id')

        ->join('products','products.id','=','deals.product_id')

        ->join('orders','orders.id','=','deals.order_id')

        ->selectRaw("products.product_name, (products.user_id) p_id, orders.order_price, orders.order_quantity, delivery.created_at, delivery.date_delivered")

        ->where(['orders.user_id' => Auth::id(), 'orders.order_remarks' => 'Complete'])

        ->get();
    }

    public function all ($remark)
    {
        $product = Product::join('products_photos','products_photos.product_id','=','products.id')
        
        ->join('products_remarks','products_remarks.product_id','=','products.id')

        ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
            'products.product_sale_price','products.created_at','products_photos.product_id',
            'products_photos.product_photo','products_photos.photo_type','products_remarks.product_status')

        ->where(['products_photos.photo_type' => 'display','products_remarks.product_status' => $remark])

        ->latest()

        ->get();

        return response()->json(['product' => $product]);
    }

    public function countView ($product,$id)
    {
        return Product::find($product)->view()->where(['viewer_id' => $id])->get();
    }

    public function validateView ($product,$id)
    {
        return Product::find($product)->view()->where(['viewer_id' => $id])->orderByRaw('created_at desc')->limit(1)->get();
    }

    public function show () 
    {
        return User::find(auth::id())->product()
        
        ->join('products_photos','products_photos.product_id','=','products.id')

        ->join('products_remarks','products_remarks.product_id','=','products.id')

        ->join('product_stocks','product_stocks.product_id','=','products.id')

        ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
        'products.product_sale_price','products.created_at','products_photos.product_id','products_photos.product_photo',
        'products_photos.photo_type','products_remarks.product_status','products_remarks.avail_promo','product_stocks.stock_quantity',
        'product_stocks.stock_status')

        ->where(['products_photos.photo_type' => 'display'])

        ->latest()

        ->get(10);
    }

    public function users ($id) 
    {
        return User::find($id)->product()
        
        ->join('products_photos','products_photos.product_id','=','products.id')

        ->join('products_remarks','products_remarks.product_id','=','products.id')

        ->join('product_stocks','product_stocks.product_id','=','products.id')

        ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
        'products.product_sale_price','products.created_at','products_photos.product_id','products_photos.product_photo',
        'products_photos.photo_type','products_remarks.product_status','products_remarks.avail_promo','product_stocks.stock_quantity',
        'product_stocks.stock_status')

        ->where(['products_photos.photo_type' => 'display', 'products_remarks.product_status' => 'Approve'])

        ->latest()

        ->get();
    }

    public function search ($type, $value, $id = 0)
    {   
        
        switch($type)
        {
            case 'tag' :

                $input = '%'.$value.'%';

                return User::find(auth::id())->product()
    
                ->join('products_photos','products_photos.product_id','=','products.id')
        
                ->join('products_remarks','products_remarks.product_id','=','products.id')
        
                ->join('product_stocks','product_stocks.product_id','=','products.id')
        
                ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
                'products.product_sale_price','products.created_at','products_photos.product_id','products_photos.product_photo',
                'products_photos.photo_type','products_remarks.product_status','products_remarks.avail_promo','product_stocks.stock_quantity',
                'product_stocks.stock_status')

                ->where('products_photos.photo_type','=','display')
        
                ->Where('products.product_tags','like', $input)
        
                ->latest()
        
                ->paginate(10);

            break;

            case 'search-tag' :
            
                $input = '%'.$value.'%';

                return Product::join('products_photos','products_photos.product_id','=','products.id')
        
                ->join('products_remarks','products_remarks.product_id','=','products.id')
        
                ->join('product_stocks','product_stocks.product_id','=','products.id')
        
                ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
                'products.product_sale_price','products.created_at','products_photos.product_id','products_photos.product_photo',
                'products_photos.photo_type','products_remarks.product_status','products_remarks.avail_promo','product_stocks.stock_quantity',
                'product_stocks.stock_status')

                ->where('products_photos.photo_type','=','display')
        
                ->Where('products.product_tags','like', $input)
        
                ->latest()
        
                ->paginate(10);

            break;
            
            case 'oldest' : 

                return User::find($id)->product()
                
                ->join('products_photos','products_photos.product_id','=','products.id')

                ->join('products_remarks','products_remarks.product_id','=','products.id')

                ->join('product_stocks','product_stocks.product_id','=','products.id')

                ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
                'products.product_sale_price','products.created_at','products_photos.product_id','products_photos.product_photo',
                'products_photos.photo_type','products_remarks.product_status','products_remarks.avail_promo','product_stocks.stock_quantity',
                'product_stocks.stock_status')

                ->where(['products_photos.photo_type' => 'display','products_remarks.product_status' => 'Approve'])

                ->oldest()

                ->paginate(10);

            break;

            case 'lastest' : 
            
                return User::find($id)->product()
                
                ->join('products_photos','products_photos.product_id','=','products.id')

                ->join('products_remarks','products_remarks.product_id','=','products.id')

                ->join('product_stocks','product_stocks.product_id','=','products.id')

                ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
                'products.product_sale_price','products.created_at','products_photos.product_id','products_photos.product_photo',
                'products_photos.photo_type','products_remarks.product_status','products_remarks.avail_promo','product_stocks.stock_quantity',
                'product_stocks.stock_status')

                ->where(['products_photos.photo_type' => 'display','products_remarks.product_status' => 'Approve'])

                ->latest()

                ->paginate(10);

            break;

            case 'lowest' : 
            
                return User::find($id)->product()
                
                ->join('products_photos','products_photos.product_id','=','products.id')

                ->join('products_remarks','products_remarks.product_id','=','products.id')

                ->join('product_stocks','product_stocks.product_id','=','products.id')

                ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
                'products.product_sale_price','products.created_at','products_photos.product_id','products_photos.product_photo',
                'products_photos.photo_type','products_remarks.product_status','products_remarks.avail_promo','product_stocks.stock_quantity',
                'product_stocks.stock_status')

                ->where(['products_photos.photo_type' => 'display','products_remarks.product_status' => 'Approve'])

                ->orderByRaw('products.product_regular_price asc')

                ->latest()

                ->paginate(10);

            break;

            case 'highest' : 
            
                return User::find($id)->product()
                
                ->join('products_photos','products_photos.product_id','=','products.id')

                ->join('products_remarks','products_remarks.product_id','=','products.id')

                ->join('product_stocks','product_stocks.product_id','=','products.id')

                ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
                'products.product_sale_price','products.created_at','products_photos.product_id','products_photos.product_photo',
                'products_photos.photo_type','products_remarks.product_status','products_remarks.avail_promo','product_stocks.stock_quantity',
                'product_stocks.stock_status')

                ->where(['products_photos.photo_type' => 'display','products_remarks.product_status' => 'Approve'])

                ->orderByRaw('products.product_regular_price desc')
                
                ->latest()

                ->paginate(10);

            break;
            
            case 'lowestTag' :

                $input = '%'.$value.'%';

                return Product::join('products_photos','products_photos.product_id','=','products.id')

                ->join('products_remarks','products_remarks.product_id','=','products.id')

                ->join('product_stocks','product_stocks.product_id','=','products.id')

                ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
                'products.product_sale_price','products.created_at','products_photos.product_id','products_photos.product_photo',
                'products_photos.photo_type','products_remarks.product_status','products_remarks.avail_promo','product_stocks.stock_quantity',
                'product_stocks.stock_status')

                ->where(['products_photos.photo_type' => 'display','products_remarks.product_status' => 'Approve'])

                ->where('products.product_tags','Like', $input)

                ->orderByRaw('products.product_regular_price asc')

                ->latest()

                ->paginate(10);

            break;

            case 'highestTag' :
            
                $input = '%'.$value.'%';

                return Product::join('products_photos','products_photos.product_id','=','products.id')

                ->join('products_remarks','products_remarks.product_id','=','products.id')

                ->join('product_stocks','product_stocks.product_id','=','products.id')

                ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
                'products.product_sale_price','products.created_at','products_photos.product_id','products_photos.product_photo',
                'products_photos.photo_type','products_remarks.product_status','products_remarks.avail_promo','product_stocks.stock_quantity',
                'product_stocks.stock_status')

                ->where(['products_photos.photo_type' => 'display','products_remarks.product_status' => 'Approve'])

                ->where('products.product_tags','Like', $input)

                ->orderByRaw('products.product_regular_price desc')

                ->latest()

                ->paginate(10);

            break;

            case 'lastestTag' :
            
                $input = '%'.$value.'%';

                return Product::join('products_photos','products_photos.product_id','=','products.id')

                ->join('products_remarks','products_remarks.product_id','=','products.id')

                ->join('product_stocks','product_stocks.product_id','=','products.id')

                ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
                'products.product_sale_price','products.created_at','products_photos.product_id','products_photos.product_photo',
                'products_photos.photo_type','products_remarks.product_status','products_remarks.avail_promo','product_stocks.stock_quantity',
                'product_stocks.stock_status')

                ->where(['products_photos.photo_type' => 'display','products_remarks.product_status' => 'Approve'])

                ->where('products.product_tags','Like', $input)

                ->orderByRaw('products.product_regular_price desc')

                ->latest()

                ->paginate(10);

            break;

            case 'lowestTag' :
            
                $input = '%'.$value.'%';

                return Product::join('products_photos','products_photos.product_id','=','products.id')

                ->join('products_remarks','products_remarks.product_id','=','products.id')

                ->join('product_stocks','product_stocks.product_id','=','products.id')

                ->select('products.id','products.product_category','products.product_name','products.product_regular_price',
                'products.product_sale_price','products.created_at','products_photos.product_id','products_photos.product_photo',
                'products_photos.photo_type','products_remarks.product_status','products_remarks.avail_promo','product_stocks.stock_quantity',
                'product_stocks.stock_status')

                ->where(['products_photos.photo_type' => 'display','products_remarks.product_status' => 'Approve'])

                ->where('products.product_tags','Like', $input)

                ->orderByRaw('products.product_regular_price desc')

                ->latest()

                ->paginate(10);

            break;
        }
    }
}