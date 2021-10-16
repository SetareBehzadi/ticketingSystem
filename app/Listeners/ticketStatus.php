<?php

namespace App\Listeners;

use App\Events\ReplyTicket;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ticketStatus
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
     * @param  object  $event
     * @return void
     */
    public function handle(ReplyTicket $event)
    {
        //HATMAN STATUS GHABLI SEFR BASHE and reply ro khode user dade na poshtiban
        if ($event->reply->ticket->isCreated() && $event->user->isAdmin() ){
            $event->reply->ticket->isReplied();
        }
    }
}
