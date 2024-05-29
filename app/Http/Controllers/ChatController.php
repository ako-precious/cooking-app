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

    public function fetchMessages($id)
    {
        return response()->json( Chat::where('meal_schedule_id', $id)->get());
    }

    public function sendMessage(Request $request )
    {
        $chat = Chat::create([
            'user_id' => $request->user,
            'meal_schedule_id' => $request->meal_schedule_id,
            'message' => $request->message
        ]);

        broadcast(new MessageSent($chat))->toOthers();
        return response()->json( Chat::where('meal_schedule_id', $request->meal_schedule_id)->get());
        // return ['status' => 'Message Sent!'];
    }
}

