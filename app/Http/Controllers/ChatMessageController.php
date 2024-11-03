<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatMessageController extends Controller
{
    public function create(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
            'message_type' => 'in:text,image,file',
            'attachment_url' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Membuat pesan baru
        $chatMessage = ChatMessage::create([
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'message_type' => $request->message_type ?? 'text',
            'attachment_url' => $request->attachment_url,
        ]);

        return response()->json(['message' => 'Message sent successfully', 'data' => $chatMessage], 201);
    }


    public function get($sender_id, $receiver_id)
    {
        $sender = User::find($sender_id);
        $receiver = User::find($receiver_id);

        if (!$sender || !$receiver) {
            return response()->json(['message' => 'Sender or receiver not found'], 404);
        }

        $messages = ChatMessage::where(function ($query) use ($sender_id, $receiver_id) {
            $query->where('sender_id', $sender_id)->where('receiver_id', $receiver_id);
        })
            ->orWhere(function ($query) use ($sender_id, $receiver_id) {
                $query->where('sender_id', $receiver_id)->where('receiver_id', $sender_id);
            })
            ->orderBy('timestamp', 'asc')
            ->get();

        return response()->json(['messages' => $messages]);
    }
}
