<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetSend extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {

        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('nashaat.mohamed.969@gmail.com')
        ->subject("From Karma-shop")
        ->view("users.Email.PasswordRestEmail")
        ->with([
            "email" => $this->data["email"],
            "token" => $this->data["token"]
        ]);
    }
}
