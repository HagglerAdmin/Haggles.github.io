<?php

namespace App\Listeners;

use App\Events\Registration;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class registerVerification
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
     * @param  Registration  $event
     * @return void
     */
    public function handle(Registration $event)
    {
        $data = array('email' => $event->request->input('email_address'), 'id' => $event->user->id);
		
		Mail::send('emails.register-verification',
		['data' => $data], 
		function ($message) use ($data) {
		    $message->from('penpen09280@gmail.com', 'Haggles');
		    $message->to($data['email'])->subject('Email Verification - Haggle');
        });
    }
}
