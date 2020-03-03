<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendDefaultPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $sPassword;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sPassword)
    {
        $this->sPassword = $sPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('New Password')
            ->view('emails.default_pass');
    }
}
