<?php

namespace App\Mail;


use App\Models\Item;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ItemBill extends Mailable
{
    use Queueable, SerializesModels;

    public $item;
    public $bid;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Item $item, $bid, User $user)
    {
        //
        $this->item = $item;
        $this->bid = $bid;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('itemBill');
    }
}
