<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends ApiController
{

    public function getBidsHistory(Request $request)
    {
        $user = $request->user();
        $bids = $user->bids->groupBy('item_id');
        return $this->successResponse($bids->map(function ($item, $key) use ($user) {
            $current_item = Item::withTrashed()->find($key);
            $date_now = Carbon::now();
            $date_end = new Carbon($current_item->auction_end);
            if ($date_now->lessThan($date_end)) {
                $state = 'In progress';
            } else {
                $last_bid = $current_item->bids->last();
                if ($last_bid->user_id === $user->id) {
                    $state = 'Won';
                } else {
                    $state = 'Lost';
                }
            }
            return ['bids' => $item, 'state' => $state, 'item' => $current_item];
        }));
    }

    public function getAwardedItems(Request $request)
    {
        $user = $request->user();

        return $this->successResponse($user->awardedItems);
    }

    public function getAwardedItemById(Request $request, $id)
    {
        $user = $request->user();
        $item = $user->awardedItems()->findOrFail($id);
        if (isset($item))
            return $this->successResponse([$item, $item->bids->last()->bid]);
    }

}
