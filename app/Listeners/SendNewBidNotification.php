<?php

namespace App\Listeners;

use App\Events\AuctionRegistered;
use App\Mail\NewBid;
use App\Models\Auction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewBidNotification implements ShouldQueue
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
     * @param  \App\Events\AuctionRegistered  $event
     * @return void
     */
    public function handle(AuctionRegistered $event)
    {
        $auction = $event->auction;

        $bids = Auction::where([['item_id', $auction->item_id], ['user_id','!=',$auction->user_id]])->with('user')->get();

        $emails = $bids->map(function ($item) {
            return $item->user->email;
        })->unique()->toArray();

        Mail::to($emails)->send(new NewBid($auction->item, $auction->bid));
    }
}
