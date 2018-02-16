<?php

namespace App\Listeners;

use App\ProductsDimension;
use App\Events\NewProduct;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductDimension
{

    public function __construct()
    {
        //
    }

    public function handle(NewProduct $event)
    {
        $dimension = new ProductsDimension();

        $dimension->product_length = $event->request->input('product_length');
        $dimension->product_width = $event->request->input('product_width');
        $dimension->product_height = $event->request->input('product_height');
        $dimension->product_weight = $event->request->input('product_weight');

        $event->product->productdimension()->save($dimension);
    }
}
