<?php

namespace App\Listeners;

use App\ProductsRemarks;
use App\Events\NewProduct;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductRemark
{

    public function __construct()
    {
        //
    }

    public function handle(NewProduct $event)
    {
        $remark = new ProductsRemarks();

        $remark->product_condition = $event->request->input('product_condition');
        $remark->trial_start = "Null";
        $remark->trial_exp = "Null";
        $remark->product_status = "Pending";

        $event->product->remarks()->save($remark);

    }
}
