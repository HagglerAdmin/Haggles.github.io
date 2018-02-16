<?php

namespace App\Events;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BargainDeal
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public $request;

    public function __construct(Order $order, Request $request)
    {
        $this->order = $order;
        $this->request = $request;
    }

}
