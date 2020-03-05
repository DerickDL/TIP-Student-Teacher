<?php

namespace App\Listeners;

use App\Events\RegisteredInstructor;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendCredentials
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
     * @param  RegisteredInstructor  $event
     * @return void
     */
    public function handle(RegisteredInstructor $event)
    {
        $sReceiver = $event->aPayload['receiver_email'];
        unset($event->aPayload['receiver_email']);
        Mail::to($sReceiver)->send(new \App\Mail\SendDefaultCredentials($event->aPayload));
    }
}
