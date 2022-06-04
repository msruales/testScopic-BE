<?php

namespace App\Mail;

use App\Models\Item;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewBid extends Mailable
{
    use Queueable, SerializesModels;

    public $item;
    public $bid;

    /**
     * Create a new message instance.
     *
     * @param Item $item
     * @param $bid
     */
    public function __construct(Item $item, $bid)
    {
        $this->item = $item;
        $this->bid = $bid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('newBid');
    }
}
