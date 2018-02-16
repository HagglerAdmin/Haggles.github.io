<?php

namespace App\Listeners;

use App\Events\ViewProduct;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class View
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
     * @param  ViewProduct  $event
     * @return void
     */
    public function handle(ViewProduct $event)
    {
        
    }
}
