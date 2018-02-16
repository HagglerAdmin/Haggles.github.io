<?php

namespace App\Listeners;

use App\Events\EditProduct;
use App\Product;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EditDimension
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

        ->productdimension()

        ->update([
            'product_length' => $event->request->input('product_length'),
            'product_width'  => $event->request->input('product_width'),
            'product_height' => $event->request->input('product_height'),
            'product_weight' => $event->request->input('product_weight')
        ]);
    }
}
