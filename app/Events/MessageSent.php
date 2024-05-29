<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use App\Models\Chat;
use App\Models\User;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $chat;

    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.'.$this->chat->meal_schedule_id);
    }
    // public $message;

    // /**
    //  * Create a new event instance.
    //  *
    //  * @return void
    //  */
    // public function __construct( Chat $message)
    // {
    //     $this->message = $message;
    // }

    // /**
    //  * Get the channels the event should broadcast on.
    //  *
    //  * @return array
    //  */
    // public function broadcastOn()
    // {
    //     return new Channel('chat');
    // }

    // // public function broadcastAs()
    // // {
    // //     return 'chat';
    // // }
    
}
