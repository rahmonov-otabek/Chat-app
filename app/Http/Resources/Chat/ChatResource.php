<?php

namespace App\Http\Resources\Chat;

use App\Http\Resources\Message\MessageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd(MessageResource::make($this->lastMessage)->withoutWrapping(), new MessageResource($this->lastMessage), MessageResource::make($this->lastMessage)->resolve(), $this->lastMessage);
        return [
            'id' => $this->id,
            'title' => $this->title ?? 'With ' . $this->chatWith->name,
            'users' => $this->users,
            'last_message' => MessageResource::make($this->lastMessage)->resolve(),
            'unreadable_count' => $this->unreadable_message_statuses_count,
        ];
    }
}
