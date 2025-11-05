<?php

namespace App\Listeners;

use App\Events\MessageSent;
use function Symfony\Component\String\b;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageListener
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
    public function handle(object $event): void
    {
        broadcast(new MessageSent($event->user))->toOthers();
    }
}
