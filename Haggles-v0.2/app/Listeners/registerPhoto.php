<?php

namespace App\Listeners;

use App\Events\Registration;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class registerPhoto
{

    public function __construct()
    {

    }

    public function handle(Registration $event)
    {
        //
    }
}
