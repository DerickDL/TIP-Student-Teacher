<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendDefaultPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $aRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($aRequest)
    {
        $this->aRequest = $aRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('New Account')
            ->view('emails.default_pass');
    }
}
