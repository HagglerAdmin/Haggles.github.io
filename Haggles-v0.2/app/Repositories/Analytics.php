<?php 

namespace App\Repositories;

use App\Order;
use App\StockHistory;
use App\Product;
use Auth;

class Analytics 
{   
    public function storeDemand ()
    {
        return Order::join('products','products.id','=','orders.product_id')

        ->selectRaw("count(orders.product_id) demand,(orders.created_at) date")        

        ->groupBy('date','product_id')
        
        ->orderByRaw('date desc')

        ->where(['products.user_id' => Auth::id(), 'orders.order_remarks' => "Complete"])

        ->get();
    }

    public function productLeaderBoard ()
    {
        return Product::join('orders','orders.product_id','=','products.id')

        ->join('products_photos','products_photos.product_id','=','orders.product_id')

        ->selectRaw('sum(orders.order_price) total_sales, count(orders.id) total_demand, products.product_name, products_photos.product_photo')

        ->groupBy('products.product_name','products_photos.product_photo')

        ->orderBy('total_demand','desc')

        ->where(['products.user_id' => Auth::id(), 'products_photos.photo_type' => 'Display', 'orders.order_remarks' => 'Complete' ])

        ->get();
    }

    public function totalSupply ()
    {
        return Product::join('product_stocks','product_stocks.product_id','=','products.id')
        
        ->selectRaw('sum(stock_quantity) stock')
        
        ->where('products.user_id', Auth::id())

        ->get();
    }

    public function productCategory ()
    {
        return Product::selectRaw('count(id) number,product_category')
        
        ->groupBy('product_category')

        ->orderBy('id')

        ->where('user_id', Auth::id())->get();
    }

    /** supply & date **/
    public function storeSupply ()
    {
        return StockHistory::selectRaw("SUM(stock_qty) supply, (created_at) date")

        ->groupBy('date')

        ->orderByRaw('date asc')
        
        ->where(['stock_type' => 'all', 'user_id' => Auth::id()])

        ->get();
    }

    public function storeSales ()
    {   
        return Order::join('products','products.id','=','orders.product_id')
        
        ->selectRaw("SUM(orders.order_price) sales, date(orders.created_at) date")

        ->groupBy('date')

        ->orderByRaw('date desc')
        
        ->where(['orders.order_remarks' => 'Complete', 'products.user_id' => Auth::id()])

        ->get();
    }

    public function pendingOrder ()
    {
        return Order::join('products','products.id','=','orders.product_id')
        
        ->join('products_photos','products_photos.product_id','=','orders.product_id')
        
        ->join('deals','deals.order_id','=','orders.id')

        ->select('orders.*','products.product_name','products_photos.product_photo','deals.deal_remark')

        ->where(['products.user_id' => Auth::id(), 'products_photos.photo_type' => 'Display','orders.order_remarks' => 'Complete','deals.deal_remark' => 'Pending'])
        
        ->orderBy('orders.created_at')

        ->get();
    }

    public function pendingOrderSeller ()
    {
        return Order::join('deals','deals.order_id','=','orders.id')
        
        ->join('products','products.id','=','orders.product_id')
        
        ->join('products_photos','products_photos.product_id','=','orders.product_id')

        ->select('orders.*','products.product_name','products_photos.product_photo','deals.deal_remark')

        ->where(['orders.user_id' => Auth::id(), 'orders.order_remarks' => 'Complete','deals.deal_remark' => 'Pending' , 'products_photos.photo_type' => 'Display'])
        
        ->orderBy('orders.created_at')

        ->get();
    }
}