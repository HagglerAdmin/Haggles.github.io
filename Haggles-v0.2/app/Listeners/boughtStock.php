<?php

namespace App\Listeners;

use App\Order;
use App\Product;
use App\ProductStock;
use App\StockHistory;
use App\Notification;
use App\Events\Bought;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class boughtStock
{

    public function __construct()
    {
        //
    }

    public function handle(Bought $event)
    {   
        $orders = Order::find($event->request->input('id'));

        $stocks  = Product::find($orders->product_id)->productstock;

        $new_qty = $stocks->stock_quantity - $orders->order_quantity;

        $stock_status = $stocks->stock_status;

        if ($new_qty <= 0)
        {
            $stock_status = "Out of stock";

            Notification::create([
                'product_id' => $orders->product_id,
                'user_to' => Product::find($orders->product_id)->user_id,
                'notif_content' => 'Your product is running out of stock',
                'notif_type' => 'out-of-stock',
                'notif_remarks' => 'sent'
            ]);
        }

        //new 
        StockHistory::create(['product_id' => $stocks->product_id, 'stock_type' => 'single', 'stock_qty' => $new_qty]);
        //update
        $stocks->update(['stock_status' => $stock_status,'stock_quantity' => $new_qty]);

        //all
        $all_stock = ProductStock::join('products','products.id','=','product_stocks.product_id')
        
        ->where(['products.user_id' => Product::find($orders->product_id)->user_id])

        ->sum('product_stocks.stock_quantity');

        StockHistory::create([
            'user_id' => Product::find($orders->product_id)->user_id, 
            'stock_type' => 'all',
            'stock_qty' => $all_stock
        ]);
        
        
        if ($orders->order_remarks != "Complete")
        {
            $orders->update(['order_remarks' => 'Processing']);        
        }
    }
}
