<?php

namespace App\Listeners;

use App\Events\EditProduct;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EditProductRemark
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
        //
    }
}
