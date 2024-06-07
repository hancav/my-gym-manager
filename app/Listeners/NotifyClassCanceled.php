<?php

namespace App\Listeners;

use App\Events\ClassCanceled;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
// mail
use Illuminate\Support\Facades\Mail;
use App\Mail\ClassCanceledMail;
// use job
use App\Jobs\NotifyClassCanceledJob;

class NotifyClassCanceled
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ClassCanceled $event): void
    {
        //
        $members = $event->scheduledClass->members()->get();

        $className = $event->scheduledClass->classType->name;
        $classDateTime = $event->scheduledClass->date_time;

        $details = compact('className', 'classDateTime');
        
        //Notification::send($members, new ClassCanceledNotification($details));

        NotifyClassCanceledJob::dispatch($members, $details);
    }
}
