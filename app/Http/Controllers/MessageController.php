<?php

namespace App\Http\Controllers;

use App\Events\StoreMessageEvent;
use App\Http\Requests\Message\StoreRequest;
use App\Http\Resources\Message\MessageResource;
use App\Jobs\StoreMessageStatusJob;
use App\Models\Message; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $message = Message::create([
            'chat_id' => $data['chat_id'],
            'user_id' => auth()->id(),
            'body' => $data['body'],
        ]);

        dispatch(new StoreMessageStatusJob($data, $message));
        // StoreMessageStatusJob::dispatch($data, $message);
 
        broadcast(new StoreMessageEvent($message))->toOthers();


        return MessageResource::make($message)->resolve();
    }
}
