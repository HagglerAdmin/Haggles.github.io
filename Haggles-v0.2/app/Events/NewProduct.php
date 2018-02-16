<?php

namespace App\Events;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewProduct
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $product;

    public $request;

    public function __construct(Product $product, Request $request)
    {
        $this->product = $product;
        $this->request = $request;
    }
}
