<?php

namespace App\Events;

use App\User;
use App\Http\Requests\ValidateRegister;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Registration
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    
    public $request;

    public function __construct(User $user, ValidateRegister $request)
    {
        $this->user = $user;
        $this->request = $request;
    }
}
