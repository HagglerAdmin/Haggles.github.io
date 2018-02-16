<?php

namespace App\Listeners;

use Auth;
use App\Product;
use App\Notification;
use App\Events\Buying;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class buyNotification
{
    public function handle(Buying $event)
    {
        $notif = new Notification();

        $id = Product::find($event->request->input('id'))->user_id;

        $notif->user_from = Auth::id();
        $notif->user_to = $id;
        $notif->notif_content = "is interested to buy your product";
        $notif->notif_type = "buying";
        $notif->notif_remarks = "Pending";

        $event->order->notification()->save($notif);
    }
}