<?php

namespace App\Listeners;

use App\Events\EditProduct;
use App\Product;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EditStock
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
     * @param  EditProduct  $event
     * @return void
     */
    public function handle(EditProduct $event)
    {
        Product::find($event->request->input('product_id'))

        ->productstock()

        ->update([

            'backorder' => $event->request->input('product_backorder'),
            'stock_status' => $event->request->input('stock_status'),
            'stock_quantity' => $event->request->input('stock_quantity'),
        ]);
    }
}
