<?php

namespace App\Listeners;

use App\Events\UserPasswordChanged;
use App\Mail\UserPasswordChangeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserPasswordChangeNotify
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
     * @param  \App\Events\UserPasswordChanged  $event
     * @return void
     */
    public function handle(UserPasswordChanged $event)
    {
        Mail::to($event->user['email'])->send(new UserPasswordChangeMail($event->user));
    }
}
