<?php

namespace App\Events;

use App\Models\AutomaticOffer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AutomaticOfferUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $automatic_offer;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(AutomaticOffer $automatic_offer)
    {
        $this->automatic_offer = $automatic_offer;
    }

    public function broadcastWith()
    {
        return [
            'message' => 'updateAutomaticOffer',
            'itemId' => $this->automatic_offer->item_id,
            'createdAt' => now()->toDateTimeString(),
        ];
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('public.room');
    }
}
