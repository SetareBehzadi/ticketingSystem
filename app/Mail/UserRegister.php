<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegister extends Mailable
{
    use Queueable, SerializesModels;

        public $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->name = 'setare';

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->from('example@example.com', 'Example')
            ->markdown('mails.user.register')->with([
                'fullName' => $this->name
            ]);
    }
}
