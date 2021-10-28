<?php

namespace App\Providers;

use App\Events\ReplyTicket;
use App\Events\UserRegister;
use App\Listeners\SendVerificationEmail;
use App\Listeners\ticketStatus;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserRegister::class => [
            SendVerificationEmail::class,
        ],
        ReplyTicket::class =>[
            ticketStatus::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
