<?php 

namespace App\Repositories;

use App\Notification;
use App\User;
use Auth;

class Notifications {

    public function all ()
    {
        return Notification::where('user_to',Auth::id())->latest()->get();
    }
}