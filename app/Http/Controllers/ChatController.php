<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Agent;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
    public function index()
    {
        $agent = Agent::where('user_id', Auth::id())->first();

        return view('chat.index', ['agent' => $agent]);
    }

    public function startChat(Ad $ad)
    {
        $senderId = auth()->id();
        $receiverId = $ad->user_id;

        // Prevent users from starting a chat with themselves
        if ($senderId == $receiverId) {
            return redirect()->back()->with('error', 'لا يمكنك بدء محادثة مع نفسك.');
        }

        // Check if a conversation already exists between these two users for this ad
        $conversation = Conversation::where('ad_id', $ad->id)
            ->where(function ($query) use ($senderId, $receiverId) {
                $query->where(function ($q) use ($senderId, $receiverId) {
                    $q->where('sender_id', $senderId)->where('receiver_id', $receiverId);
                })->orWhere(function ($q) use ($senderId, $receiverId) {
                    $q->where('sender_id', $receiverId)->where('receiver_id', $senderId);
                });
            })->first();

        // If no conversation exists, create a new one
        if (!$conversation) {
            $conversation = Conversation::create([
                'ad_id' => $ad->id,
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
            ]);
        }

        // Redirect to the main chat page with the specific conversation selected
        return redirect()->route('chat.index', ['conversation' => $conversation->id]);
    }
}