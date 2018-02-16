<?php

namespace App\Listeners;

use Auth;
use App\Order;
use App\Notification;
use App\Events\Bought;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyBuyer
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
     * @param  Bought  $event
     * @return void
     */
    public function handle(Bought $event)
    {   
        $order_id = $event->request->input('id');

        $order = Order::find($order_id);

        if ($order->order_remarks != "Complete")
        {
            Notification::create([
                'order_id' => $order_id,
                'user_from' => Auth::id(),
                'user_to' => $order->user_id,
                'notif_content' => "Has Accept your offer",
                'notif_type' => "bargain-accept",
                'notif_remarks' => "Sent"
            ]);
        }
    }
}
