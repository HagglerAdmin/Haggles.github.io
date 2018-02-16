<?php

namespace App\Listeners;

use App\Bargain;
use Auth;
use App\Events\NewProduct;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BargainRoom
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
        $bargain = new Bargain();

        $bargain->user_id = Auth::id();

        $event->product->bargain()->save($bargain);
    }
}
