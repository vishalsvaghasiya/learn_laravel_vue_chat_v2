<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\ChatRoom;
use Illuminate\Http\Request;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function rooms(Request $request)
    {
        return ChatRoom::all();
    }

    public function messages($roomId)
    {
//        return 'vish';
        $chatMessage = ChatMessage::where('chat_room_id', $roomId)->with('user')->orderBy('created_at', 'DESC')->get();
        return $chatMessage;
    }

    public function newMessage(Request $request, $roomId)
    {
        $newMessage = new ChatMessage();
        $newMessage->user_id = Auth::id();
        $newMessage->chat_room_id = $roomId;
        $newMessage->message = $request->message;
        $newMessage->save();


        // BroadCast Event
        broadcast(new NewChatMessage(auth()->user(), $newMessage))->toOthers();
        return $newMessage;
    }
}
