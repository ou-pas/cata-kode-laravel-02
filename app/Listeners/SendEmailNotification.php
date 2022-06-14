<?php

namespace App\Listeners;

use App\Events\AppointmentRegistered;
use App\Notifications\AppointmentRegisteredNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendEmailNotification
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
     * @param  AppointmentRegistered  $event
     * @return void
     */
    public function handle(AppointmentRegistered $event)
    {
        Notification::route('mail', $event->appointment->getAttribute('email'))
            ->notify(new AppointmentRegisteredNotification($event->appointment));
    }
}
