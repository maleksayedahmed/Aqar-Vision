<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display the chat interface.
     * It dynamically determines which layout to use based on the user's role.
     */
    public function index()
    {
        $user = Auth::user();
        $layout = 'layouts.app'; // Default to the regular user layout

        // Check if the user has an associated agent profile.
        if ($user && $user->agent) {
            $layout = 'layouts.agent'; // If they are an agent, use the agent layout.
        }
        
        // Get the conversation ID from the route or query string
        $conversationId = request()->query('conversation');

        // Return the view and pass the correct layout name and conversation ID.
        return view('chat.index', [
            'layout' => $layout,
            'conversationId' => $conversationId,
        ]);
    }

    /**
     * Start a new chat with the owner of an ad.
     */
    public function startChat(Ad $ad)
    {
        $senderId = auth()->id();
        $receiverId = $ad->user_id;

        if ($senderId == $receiverId) {
            return redirect()->back()->with('error', 'لا يمكنك بدء محادثة مع نفسك.');
        }

        // Find or create the conversation
        $conversation = Conversation::firstOrCreate(
            [
                'ad_id' => $ad->id,
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
            ]
        );

        return redirect()->route('chat.index', ['conversation' => $conversation->id]);
    }
}