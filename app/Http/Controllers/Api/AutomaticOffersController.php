<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AutomaticOfferRequest;
use App\Models\AutomaticOffer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AutomaticOffersController extends ApiController
{

    public function storeOrUpdate(AutomaticOfferRequest $request)
    {

        if(!$request->user()->config || $request->user()->config->amount <= 0){
            return $this->errorResponse([],500,'config_bidding');
        }

        $user_id = $request->user()->id;
        $data = $request->validated();
        $data['user_id'] = $user_id;

        $automatic_offer_update = AutomaticOffer::where([['user_id', $user_id], ['item_id', $data['item_id']]])->first();

        if ($automatic_offer_update) {
            $status = $automatic_offer_update->status;
            $data['status'] = !$status;
            $automatic_offer_update->update($data);
            $automatic_offer_update->item;

            return $this->successResponse([
                'isActive' => $automatic_offer_update->status,
                'item' => $automatic_offer_update,
                'carbon' => Carbon::now('America/Guayaquil')

            ]);
        } else {

            $automatic_offer = AutomaticOffer::create($data);
            $automatic_offer->refresh();
            return $this->successResponse(['isActive' => $automatic_offer->status]);
        }
    }
    public function show(Request $request)
    {
        $item_id = $request->item_id;
        $user_id = $request->user()->id;

        $automatic_offer = AutomaticOffer::where([['user_id', $user_id], ['item_id', $item_id]])->first();

        $status = $automatic_offer ? $automatic_offer->status : false;

        return $this->successResponse(['isActive' => $status]);
    }

}
