<?php

namespace App\Listeners;

use App\Notification;
use Auth;
use App\Events\BargainDeal;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifySeller
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
     * @param  BargainDeal  $event
     * @return void
     */
    public function handle(BargainDeal $event)
    {
        $notify = new Notification();

        $notify->notif_content = "Has Accept your offer";
        $notify->user_from = Auth::id();
        $notify->user_to = $event->order->user_id;
        $notify->notif_type = "bargain-accept";
        $notify->notif_remarks = "sent";

        $event->order->notification()->save($notify);
    }
}
