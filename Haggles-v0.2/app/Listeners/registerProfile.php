<?php

namespace App\Listeners;

use App\Events\Registration;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\UsersProfile;

class registerProfile
{
    public function __construct()
    {

    }

    public function handle(Registration $event)
    {
        $profile = new UsersProfile();

        $profile->phone_number = $event->request->input('phonenumber');
        $profile->email_address = $event->request->input('email_address');
        
        $event->user->profile()->save($profile);
    }
}
