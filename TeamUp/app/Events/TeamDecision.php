<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TeamDecision implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $text;
    public $id;
    public $type;
    public $title;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($type, $title, $text, $id)
    {
        $this->text = $text;
        $this->id = $id;
        $this->type = $type;
        $this->title = $title;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('my-channel-' . $this->id);
    }

    public function broadcastAs(){
        return 'my-event';
    }
}
