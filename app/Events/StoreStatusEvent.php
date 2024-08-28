<?php

namespace App\Events;

use App\Http\Resources\Message\MessageResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoreStatusEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $count;
    private $chatId;
    private $userId;
    private $message;
    /**
     * Create a new event instance.
     */
    public function __construct($count, $chatId, $userId, $message)
    {
        $this->count = $count;
        $this->chatId = $chatId;
        $this->chatId = $userId;
        $this->chatId = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('users.'. $this->userId),
        ];
    }
    
    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'store-message-status';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'chat_id' => $this->chatId,
            'count' => $this->count,
            'message' => MessageResource::make($this->message)->resolve()
        ];
    }
}
