<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendDefaultCredentials extends Mailable
{
    use Queueable, SerializesModels;

    public $aRequest;

    /**
     * Create a new message instance.
     *
     * @param array
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
