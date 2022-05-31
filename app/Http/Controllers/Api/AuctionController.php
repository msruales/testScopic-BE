<?php

namespace App\Http\Controllers\Api;

use App\Events\AuctionRegistered;
use App\Http\Requests\AuctionRequest;
use App\Models\Auction;
use Validator;

class AuctionController extends ApiController
{
    public function store(AuctionRequest $request)
    {

        $data = $request->validated();

        $data = array_merge($data, ['user_id' => $request->user()->id]);

        $auction = Auction::create($data);

        event( new AuctionRegistered($auction));

        return $this->successResponse(['auction' => $auction]);

    }
}
