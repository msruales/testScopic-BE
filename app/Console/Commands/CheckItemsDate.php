<?php

namespace App\Console\Commands;

use App\Mail\AuctionEnded;
use App\Mail\ItemBill;
use App\Models\Item;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckItemsDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'items:date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Check if the item's end date is reached and send an email to the auction winner";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $now = now();
            $items = Item::whereNull('item_owner')->whereDate('auction_end', '<=', $now)->get();
            $info = 'Mail sent to ';
            foreach ($items as $item) {
                $date_end = new Carbon($item->auction_end);
                if ($now->greaterThanOrEqualTo($date_end)) {
                    $bids = $item->bids;
                    if ($bids->isNotEmpty()) {
                        $last_bid = $bids->last();
                        $item->item_owner = $last_bid->user->id;
                        $item->save();

                        $automatic_items = $item->automaticItems;
                        foreach ($automatic_items as $automatic_item){
                            $automatic_item->status = 0;
                            $automatic_item->save();
                        }

                        Mail::to($last_bid->user->email)->send(new ItemBill($item, $last_bid->bid, $last_bid->user));
                        $info .= $last_bid->user->email;

                        $filter_bids = $bids->where('user_id','!=',$last_bid->user_id);

                        $emails = $filter_bids->map(function($bid){
                            return $bid->user->email;
                        })->unique()->toArray();

                        Mail::to($emails)->send(new AuctionEnded($item));

                    }
                }
            }
            $this->info(
                $info
            );
        } catch (Exception $ex) {
            $this->info(
                'There was an error sending the email'
            );
        }
        return 0;
    }
}
