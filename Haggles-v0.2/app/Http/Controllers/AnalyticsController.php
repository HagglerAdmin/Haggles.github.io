<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\StockHistory;
use App\Product;
use App\User;

class AnalyticsController extends Controller
{

    public function index()
    {   
        $leader_board = (new \App\Repositories\Analytics)->productLeaderBoard();

        $total_supply = (new \App\Repositories\Analytics)->totalSupply();

        $category_count = (new \App\Repositories\Analytics)->productCategory();

        $pendingOrders = (new \App\Repositories\Analytics)->pendingOrder();
        
        $pendingOrderSeller = (new \App\Repositories\Analytics)->pendingOrderSeller();

        $product = (new \App\Repositories\Products)->users(Auth::id());

        $product_sales = (new \App\Repositories\Products)->sales();

        $product_history = (new \App\Repositories\Products)->buyHistory();

        return view('analytics.analytics', compact('leader_board','pendingOrders','pendingOrderSeller','product','product_sales','product_history','category_count','total_supply'));
    }

    public function demand(Request $request) 
    {
        return Product::join('orders','orders.product_id','=','products.id')
        
        ->selectRaw("count(product_id) product_id, product_name, order_price")

        ->groupBy('product_name','product_id','order_price')

        ->orderByRaw('order_price asc')

        ->where(['products.id' => $request->input('id'), 'orders.order_remarks' => 'Complete'])

        ->get();
    }

    public function supply(Request $request)
    { 
        return StockHistory::join('products','products.id','=','stock_histories.product_id')
        
        ->selectRaw("products.product_name, (stock_histories.stock_qty) product_regular_price, (stock_histories.created_at) stock_quantity")

        ->orderByRaw("stock_histories.created_at asc")

        ->where(['product_id' => $request->input('id'), 'stock_type' => 'single'])->get();
    }

    public function storeDemand(Request $request)
    {
        return (new \App\Repositories\Analytics)->storeDemand();
    }

    public function storeSupply() 
    {
        return (new \App\Repositories\Analytics)->storeSupply();
    }

    public function sales() 
    {   
        return (new \App\Repositories\Analytics)->storeSales();
    }

    public function categoryBought()
    {   
        return (new \App\Repositories\Products)->categoryBought();
    }
}
