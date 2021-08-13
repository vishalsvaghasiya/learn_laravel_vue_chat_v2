<?php

namespace App\Events;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewChatMessage implements ShouldBroadcast
{
    //Todo: miss -> implements ShouldBroadcast
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $chatMessage;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, ChatMessage $chatMessage)
    {
        //
        $this->user = $user;
        $this->chatMessage = $chatMessage;
    }

//    public function __construct(\App\Models\User $user, ChatMessage $message)
//    {
//        $this->user = $user;
//        $this->chatMessage = $message;
//    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
//        return new PrivateChannel('channel-name');
        return new PrivateChannel('chat');
//        return new PrivateChannel('chat.' . $this->chatMessage->chat_room_id);
    }
}
