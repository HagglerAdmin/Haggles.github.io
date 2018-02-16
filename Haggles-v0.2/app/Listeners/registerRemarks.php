<?php

namespace App\Listeners;

use App\UsersRemarks;
use App\Events\Registration;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class registerRemarks
{
    public function __construct()
    {
    
    }

    public function handle(Registration $event)
    {
        $remark = new UsersRemarks();

        $remark->account_type = "Normal";
        $remark->user_status = "Good";
        $remark->premium_exp = "Null";
        $remark->account_status = "Inactive";

        $event->user->remark()->save($remark);
    }
}
