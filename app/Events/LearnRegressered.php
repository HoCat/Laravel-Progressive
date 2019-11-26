<?php

namespace App\Events;

use App\Models\Learn;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LearnRegressered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $learn;

    /**
     * Create a new event instance.
     *
     * @param Learn $learn
     */
    public function __construct(Learn $learn)
    {
        //
        $this->learn = $learn;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
