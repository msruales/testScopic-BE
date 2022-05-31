<?php

namespace App\Mail;


use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AutoBiddingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $type_message;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $user, $type_message)
    {
        //
        $this->user = $user;
        $this->type_message = $type_message;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('autoBidding');
    }
}
