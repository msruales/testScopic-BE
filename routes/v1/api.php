<?php

use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\AuctionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AutomaticOffersController;
use App\Http\Controllers\Api\BiddingConfigController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function() {

    Route::apiResource('items', ItemController::class)->except('show');
    Route::post('view_item/{id}',[ItemController::class, 'viewItem']);
    Route::post('auctions',[AuctionController::class, 'store']);

    Route::post('config',[BiddingConfigController::class, 'storeOrUpdate']);
    Route::get('config',[BiddingConfigController::class, 'show']);

    Route::post('automatic_offer',[AutomaticOffersController::class, 'storeOrUpdate']);
    Route::get('automatic_offer',[AutomaticOffersController::class, 'show']);

    Route::get('user/bids', [UserController::class, 'getBidsHistory']);
    Route::get('user/awarded_items', [UserController::class, 'getAwardedItems']);
    Route::get('user/awarded_item/{id}', [UserController::class, 'getAwardedItemById']);
    Route::get('init', [AuthController::class, 'get_user']);

});


Route::group(['prefix' => 'auth'], function(){

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

});
