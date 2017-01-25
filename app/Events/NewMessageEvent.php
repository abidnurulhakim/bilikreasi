<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewMessageEvent implements ShouldBroadcast, ShouldQueue
{
    use SerializesModels;
    public $message;
    public $broadcastQueue = 'broadcast-discussion-message';

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $user = $message->user;
        $this->message = [
                            'id' => $message->id,
                            'discussion_id' => $message->discussion_id,
                            'type' => $message->type,
                            'content' => $message->content,
                            'user_id' => $user->id,
                            'user_name' => $user->name,
                            'user_photo' => $user->getPhoto(128),
                            'created_at' => $message->created_at->toIso8601String()
                        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('discussion.'.$this->message['discussion_id']);
    }

    public function broadcastAs()
    {
        return 'discussion.new.message';
    }
}
