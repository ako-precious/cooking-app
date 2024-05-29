<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat');
    }

    public function fetchMessages()
    {
        return Chat::all();
    }

    public function sendMessage(Request $request)
    {
        $chat = Chat::create([
            'user_id' => $request->user,
            'meal_schedule_id' => $request->meal_schedule_id,
            'message' => $request->message
        ]);

        broadcast(new MessageSent($chat))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}

