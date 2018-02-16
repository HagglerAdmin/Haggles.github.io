<?php

namespace App\Listeners;

use App\Events\Buying;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class buyingStock
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
     * @param  Buying  $event
     * @return void
     */
    public function handle(Buying $event)
    {
        //
    }
}
