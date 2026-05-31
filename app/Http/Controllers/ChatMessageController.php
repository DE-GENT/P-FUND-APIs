<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatMessageController extends Controller
{
    public function index()
    {
        $messages = ChatMessage::with('sender')->latest()->take(100)->get()->reverse()->values();
        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        $message = ChatMessage::create([
            'sender_id' => $request->user()->id,
            'message' => $request->message
        ]);

        $message->load('sender');

        return response()->json($message, 201);
    }
}
