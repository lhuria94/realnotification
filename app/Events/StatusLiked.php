<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Pusher\PushNotifications\PushNotifications;

class StatusLiked implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $username;

    public $message;

    public $beams;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($username=Null, $msg=Null)
    {
        $this->username = $username;
        $msg = ucwords($msg);
        $this->message  = $msg;
    }

    public function broadcastOn()
    {
        return new Channel('auth-request');
    }

    public function broadcastAs()
    {
        return 'key-dispatched';
    }
}
