<?php

namespace App\Jobs;

use App\Events\StoreMessageStatusEvent;
use App\Models\MessageStatus;
use App\Events\StoreStatusEvent;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class StoreMessageStatusJob implements ShouldQueue
{
    use Queueable;

    private $data;
    private $message;

    /**
     * Create a new job instance.
     */
    public function __construct($data, $message)
    {
        $this->data = $data;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach($this->data['user_ids'] as $user_id){
            MessageStatus::create([
                'chat_id' => $this->data['chat_id'],
                'message_id' => $this->message->id,
                'user_id' => $user_id,
            ]);

            $count = MessageStatus::where('chat_id', $this->data['chat_id'])
                ->where('user_id', $user_id)
                ->where('is_read', false)
                ->count();

            broadcast(new StoreMessageStatusEvent($count, $this->data['chat_id'], $user_id, $this->message));
        }
    }
}
