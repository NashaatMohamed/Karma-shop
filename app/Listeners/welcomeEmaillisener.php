<?php

namespace App\Listeners;

use App\Events\welcomeEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\WelcomeEmails;
use Mail;

class welcomeEmaillisener implements ShouldQueue
{

    public $queue = 'listeners';

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
     * @param  \App\Events\welcomeEmail  $event
     * @return void
     */
    public function handle(welcomeEmail $event)
    {
        $user = $event->user;
        $emailData = [
            "subject" => "Welcome to our Karma-shop",
            "body" => "We wish you a great experience with us Brooo :)",
            "tagline" => "jdhsjuklfdshljfd"
        ];
        Mail::to((string) $user->email)->send(new WelcomeEmails($emailData));
    }
}
