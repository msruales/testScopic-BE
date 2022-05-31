<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\BiddingConfigRequest;
use App\Models\BiddingConfig;
use Illuminate\Http\Request;


class BiddingConfigController extends ApiController
{

    public function storeOrUpdate(BiddingConfigRequest $request)
    {
        $user =  $request->user();

        $inputs = $request->validated();

        if(!$user->config){

            $config = new BiddingConfig;
            $config->amount = $inputs['amount'];
            $config->aux_amount = $inputs['amount'];
            $config->percentage_amount = $inputs['percentage_amount'];
            $config->is_send_notification = 0;
            $config->save();
            $user->config()->save($config);
        }

        $inputs['aux_amount'] = $inputs['amount'];
        $inputs['is_send_notification'] = 0;

        $user->config()->update($inputs);
        $user->refresh();

        return $this->successResponse(['config'=> $user->config]);
    }


    public function show(Request $request)
    {
        $user = $request->user();

        $bidding_config = BiddingConfig::where('user_id', $user->id)->first();

        return $this->successResponse($bidding_config);

    }

}
