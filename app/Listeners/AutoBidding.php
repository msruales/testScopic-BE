<?php

namespace App\Listeners;

use App\Events\AuctionRegistered;
use App\Events\AutomaticOfferUpdated;
use App\Mail\AutoBiddingNotification;
use App\Models\Auction;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class AutoBidding implements ShouldQueue
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


        $this->autoBidding($event->auction->item);
    }

    public function autoBidding(Item $item)
    {
        $date_now = Carbon::now();

        $automatic_items = $item->automaticItems;

        $automatic_items_active = $automatic_items->filter(function($automatic_item) use($date_now){
            $date_end = new Carbon($automatic_item->item->auction_end);
            return $automatic_item->status == 1 && $date_now->lessThan($date_end)  ;
        });


        foreach ($automatic_items_active as $key => $automatic_item) {


            $last_bid = Auction::where('item_id',$automatic_item->item_id)->orderBy('id', 'desc')->get()->first();
            $user = $automatic_item->user;

            if( $user->id !== $last_bid->user_id ){

                $current_amount = $user->config->amount;
                $current_aux_amount = $user->config->aux_amount;

                if($current_amount > 0){

                    $new_auction = new Auction;
                    $new_auction->bid = ($last_bid->bid + 1);
                    $new_auction->user_id = $user->id;
                    $new_auction->item_id = $automatic_item->item_id;
                    $new_auction->save();

                    $user->config->amount = ($current_amount - 1);
                    $user->config->save();

                    $current_percentage = (($user->config->percentage_amount*$current_aux_amount)/100);

                    if($user->config->amount <= $current_percentage && $user->config->is_send_notification === 0 ) {
                        $user->config->is_send_notification = 1;
                        $user->config->save();
                        Mail::to($user->email)->send(new AutoBiddingNotification($user, 'percentage', $new_auction));
                    }

                    if($user->config->amount == 0 ) {
                        $automatic_item->status = 0;
                        $automatic_item->save();
                        event( new AutomaticOfferUpdated($automatic_item));
                        Mail::to($user->email)->send(new AutoBiddingNotification($user, 'end', $new_auction));
                    }

                    event( new AuctionRegistered($new_auction));
                }
            }
        }
    }
}
