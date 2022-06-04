<?php

namespace App\Mail;


use App\Models\Auction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AutoBiddingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $type_message;
    public $auction;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $user, $type_message, Auction $auction)
    {
        $this->auction = $auction;
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

        $date_now = Carbon::now();
        $date_end = new Carbon($this->auction->item->auction_end);
        if ($date_now->lessThan($date_end)) {
            $state = 'In progress';
        } else {
            $last_bid = $this->auction->item->bids->last();
            if ($last_bid->user_id === $this->auction->user_id) {
                $state = 'Won';
            } else {
                $state = 'Lost';
            }
        }

        return $this->view('autoBidding')->with([
            'state' => $state,
            'item_name' => $this->auction->item->name
        ]);
    }
}
