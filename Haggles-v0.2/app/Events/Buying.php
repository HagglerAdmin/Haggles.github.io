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

class Buying
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $request;
    
    public $order;

    public function __construct(Request $request, Order $order)
    {
        $this->request = $request;
        $this->order = $order;
    }

}