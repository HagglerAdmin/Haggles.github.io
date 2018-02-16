<?php

namespace App\Listeners;

use App\ProductStock;
use App\StockHistory;
use App\Product;
use App\Notification;
use App\Events\BargainDeal;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeductStock
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BargainDeal  $event
     * @return void
     */
    public function handle(BargainDeal $event)
    {   
        // $products = Product::find($event->order->product_id);
        
        // $new_stock = $product->productstock->stock_quantity - $event->order->order_quantity;

        // $stock_status = $product->productstock->stock_status;

        // if ($new_stock <= 0)
        // {
        //     $stock_status = "Out of stock";

        //     Notification::create([
        //         'product_id' => $products->id,
        //         'user_to' => $products->user_id,
        //         'notif_content' => 'Your product is running out of stock',
        //         'notif_type' => 'out-of-stock',
        //         'notif_remarks' => 'sent'
        //     ]);
        // }

        // //new 
        // StockHistory::create(['product_id' => $products->id, 'stock_type' => 'single', 'stock_qty' => $new_stock]);
        // //old
        // StockHistory::create(['product_id' => $products->id, 'stock_type' => 'single', 'stock_qty' => $product->productstock->stock_quantity]);
        // //update
        // $stocks->update(['stock_status' => $stock_status,'stock_quantity' => $new_qty]);

    }
}