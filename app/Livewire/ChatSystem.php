<?php

namespace App\Livewire;

use App\Models\Conversation;
use App\Models\Message;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ChatSystem extends Component
{
    public $conversations;
    public $selectedConversation;
    public $chatMessages; // RENAMED from $messages to avoid Livewire conflicts
    public $newMessage;
    
    protected $listeners = ['refreshConversations' => '$refresh'];

    public function mount($conversationId = null)
    {
        // Eager load all relationships needed for the conversation list on initial load
        $this->conversations = Conversation::where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->with([
                'lastMessage', 
                'sender:id,name,profile_photo_path', // Load only necessary columns for performance
                'receiver:id,name,profile_photo_path'
            ])
            ->latest('updated_at')
            ->get();

        if ($conversationId) {
            $this->selectConversation($conversationId);
        } elseif ($this->conversations->isNotEmpty()) {
            // If no specific conversation is requested, select the most recent one by default
            $this->selectConversation($this->conversations->first()->id);
        }
    }

    public function selectConversation($conversationId)
    {
        // Eager load all relationships needed for the chat header to prevent errors
        $this->selectedConversation = Conversation::with([
            'ad.district.city', 
            'ad.propertyType'
        ])->findOrFail($conversationId);

        // Mark all messages in this conversation from the other user as "read"
        Message::where('conversation_id', $conversationId)
            ->where('user_id', '!=', auth()->id())
            ->update(['is_read' => true]);
            
        $this->loadMessages();
        
        // Dispatch browser event to trigger JavaScript (e.g., for scrolling)
        $this->dispatch('chat-selected');
    }

    public function sendMessage()
    {
        $this->validate(['newMessage' => 'required|string']);

        if (!$this->selectedConversation) {
            return; // Exit if no conversation is selected to prevent errors
        }

        Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'user_id' => auth()->id(),
            'body' => $this->newMessage,
        ]);

        // This updates the `updated_at` timestamp on the conversation,
        // which brings it to the top of the conversation list.
        $this->selectedConversation->touch(); 

        $this->newMessage = ''; // Reset the input field after sending

        $this->loadMessages(); // Reload messages to show the new one instantly
        
        // Dispatch browser event to scroll the chat box down
        $this->dispatch('message-sent');
    }

    public function loadMessages()
    {
        if ($this->selectedConversation) {
            // RENAMED from $this->messages to $this->chatMessages
            $this->chatMessages = Message::where('conversation_id', $this->selectedConversation->id)
                ->with('user:id,name,profile_photo_path') // Load sender info efficiently
                ->orderBy('created_at', 'asc')
                ->get();
        }
    }

    public function render()
    {
        // This runs on every update, including polling, to refresh the conversation list
        // This is how new messages from other users appear in the list.
        $this->conversations = Conversation::where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->with(['lastMessage', 'sender:id,name,profile_photo_path', 'receiver:id,name,profile_photo_path'])
            ->withCount(['messages as unread_count' => function ($query) {
                $query->where('is_read', false)->where('user_id', '!=', auth()->id());
            }])
            ->latest('updated_at')
            ->get();
            
        return view('livewire.chat-system');
    }
}
