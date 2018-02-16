<?php

namespace App\Listeners;

use App\ProductStock;
use App\StockHistory;
use Auth;
use App\Events\NewProduct;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Stock
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
     * @param  NewProduct  $event
     * @return void
     */
    public function handle(NewProduct $event)
    {
        $stock = new ProductStock();
        
        $stock->backorder = $event->request->input('product_backorder');
        $stock->stock_status = $event->request->input('stock_status');
        $stock->stock_quantity = $event->request->input('stock_quantity');

        $event->product->productstock()->save($stock);
        
        $all_stock = ProductStock::join('products','products.id','=','product_stocks.product_id')
        
        ->where(['products.user_id' => Auth::id()])

        ->sum('product_stocks.stock_quantity');

        StockHistory::create([ 'product_id' => $event->product->id, 'stock_type' => 'single', 'stock_qty' => $event->request->input('stock_quantity')]);
        StockHistory::create([ 'user_id' => Auth::id(), 'stock_type' => 'all', 'stock_qty' => $all_stock]);
    }
}
