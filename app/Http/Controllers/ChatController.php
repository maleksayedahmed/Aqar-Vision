<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Conversation;
use App\Models\User; // <-- IMPORT THE USER MODEL
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $layout = $user && $user->agent ? 'layouts.agent' : 'layouts.app';
        $conversationId = request()->query('conversation');

        return view('chat.index', [
            'layout' => $layout,
            'conversationId' => $conversationId,
        ]);
    }

    /**
     * Start a new chat related to a specific Ad.
     */
    public function startChat(Ad $ad)
    {
        $senderId = auth()->id();
        $receiverId = $ad->user_id;

        if ($senderId == $receiverId) {
            return redirect()->back()->with('error', 'لا يمكنك بدء محادثة مع نفسك.');
        }

        $conversation = Conversation::firstOrCreate(
            [
                'ad_id' => $ad->id,
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
            ]
        );

        return redirect()->route('chat.index', ['conversation' => $conversation->id]);
    }

    /**
     * ** NEW METHOD **
     * Start a new direct chat with a User, not related to an Ad.
     */
    public function startChatWithUser(User $user)
    {
        $sender = Auth::user();
        $receiver = $user;

        if ($sender->id == $receiver->id) {
            return redirect()->back()->with('error', 'لا يمكنك بدء محادثة مع نفسك.');
        }

        // Find a conversation that is DIRECT (ad_id is null) between these two users.
        // The query checks for both directions (sender->receiver and receiver->sender).
        $conversation = Conversation::whereNull('ad_id')
            ->where(function ($query) use ($sender, $receiver) {
                $query->where('sender_id', $sender->id)
                      ->where('receiver_id', $receiver->id);
            })
            ->orWhere(function ($query) use ($sender, $receiver) {
                $query->where('sender_id', $receiver->id)
                      ->where('receiver_id', $sender->id);
            })
            ->first();

        // If no direct conversation exists, create one.
        if (!$conversation) {
            $conversation = Conversation::create([
                'ad_id' => null, // Explicitly set ad_id to null
                'sender_id' => $sender->id,
                'receiver_id' => $receiver->id,
            ]);
        }

        return redirect()->route('chat.index', ['conversation' => $conversation->id]);
    }
}