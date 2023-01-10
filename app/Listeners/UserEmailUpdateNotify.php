<?php

namespace App\Listeners;

use App\Events\UserEmailUpdated;
use App\Mail\UserEmailUpdateMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEmailUpdateNotify
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
     * @param  \App\Events\UserEmailUpdated  $event
     * @return void
     */
    public function handle(UserEmailUpdated $event)
    {
        Mail::to($event->user['old_email'])->send(new UserEmailUpdateMail($event->user,$sent_type='old_mail'));
        Mail::to($event->user['email'])->send(new UserEmailUpdateMail($event->user,$sent_type='new_mail'));
    }
}
