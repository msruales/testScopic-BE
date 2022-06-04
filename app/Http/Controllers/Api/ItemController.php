<?php

namespace App\Http\Controllers\Api;

use App\Events\ItemUpdated;
use App\Http\Requests\ItemRequest;
use App\Models\Auction;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemController extends ApiController
{

    public function index(Request $request)
    {

        $item = Item::where([
            ['description', 'LIKE', '%' . $request->description . '%'],
            ['name', 'LIKE', '%' . $request->name . '%']])->with(['bids' => function ($query) {
            $query->latest();
        }])->get();

        return $this->successResponse($item->toArray());
    }


    public function store(ItemRequest $request)
    {
        $item = Item::create($request->validated());

        return $this->successResponse([
            'item' => $item
        ]);

    }

    public function viewItem($id, Request $request)
    {
        $last_bid = Auction::where('item_id', $id)->orderBy('id', 'desc')->get();

        if ($last_bid->first()) {
            $response = array('user_auction' => $last_bid->first(),
                'item' => $last_bid->first()->item,
                'history' => $last_bid,
                'time_left' => $this->getTimeDifference($last_bid->first()->item),
                'item_owner' => $last_bid->first()->item->itemOwner,
            );
            if ($request->user()->id === $last_bid->first()->user_id || ($response['time_left'][0] === 0 && $response['time_left'][1] === 0)) {
                return $this->successResponse(array_merge($response, [
                    'can_bid' => false,
                ]));
            } else {
                return $this->successResponse(array_merge($response, [
                    'can_bid' => true,
                ]));
            }

        } else
            return $this->successResponse(['user_auction' => null, 'item' => Item::findOrFail($id),
                'can_bid' => true, 'history' => null,
                'time_left' => $this->getTimeDifference(Item::findOrFail($id)), 'item_owner' => null]);
    }

    private function getTimeDifference($item)
    {
        $date_now = Carbon::now();
        $date_end = new Carbon($item->auction_end);

        if ($date_now->lessThan($date_end)) {
            $diff_days = $date_now->diffInDays($date_end);
            if ($diff_days == 0) {
                $seconds_left = sizeof($date_now->secondsUntil($date_end));
            } else {
                $seconds_left = $date_end->secondsUntilEndOfDay();
            }
            return [$diff_days, $seconds_left];
        } else {
            return [0, 0];
        }
    }

    public function update(ItemRequest $request, Item $item)
    {
        $item->update($request->validated());

        event( new ItemUpdated($item));

        return $this->successResponse([
            'item' => $item
        ]);

    }


    public function destroy(Item $item)
    {
        if (!$item->delete()) {
            return $this->errorResponse([]);
        }

        return $this->successResponse(['id' => $item->id]);

    }
}
