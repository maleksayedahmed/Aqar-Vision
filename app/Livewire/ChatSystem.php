<?php

namespace App\Livewire;

use App\Models\Conversation;
use App\Models\Message;
use Livewire\Component;
use Livewire\WithFileUploads; // Trait for handling file uploads
use Illuminate\Support\Facades\Auth;

class ChatSystem extends Component
{
    use WithFileUploads; // Use the file upload trait

    public $conversations;
    public $selectedConversation;
    public $chatMessages;
    public $newMessage;
    public $photo; // Property to hold the uploaded photo

    public function mount($conversationId = null)
    {
        $this->conversations = Conversation::where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->with(['lastMessage', 'sender:id,name,profile_photo_path', 'receiver:id,name,profile_photo_path'])
            ->latest('updated_at')
            ->get();

        if ($conversationId) {
            $this->selectConversation($conversationId);
        } elseif ($this->conversations->isNotEmpty()) {
            $this->selectConversation($this->conversations->first()->id);
        }
    }

    public function selectConversation($conversationId)
    {
        $this->selectedConversation = Conversation::with(['ad.district.city', 'ad.propertyType'])->findOrFail($conversationId);
        
        Message::where('conversation_id', $conversationId)
               ->where('user_id', '!=', auth()->id())
               ->update(['is_read' => true]);
               
        $this->loadMessages();
        $this->reset(['newMessage', 'photo']); // Reset inputs when changing conversation
        $this->dispatch('chat-selected');
    }

    public function sendMessage()
    {
        // Require either text or a photo, but not necessarily both
        $this->validate([
            'newMessage' => 'required_without:photo|nullable|string|max:1000',
            'photo'      => 'required_without:newMessage|nullable|image|max:2048', // 2MB Max
        ]);

        if (!$this->selectedConversation) {
            return;
        }

        $imagePath = null;
        if ($this->photo) {
            // Store the uploaded image in the 'public/chat-images' directory
            $imagePath = $this->photo->store('chat-images', 'public');
        }

        Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'user_id'         => auth()->id(),
            'body'            => $this->newMessage,
            'image_path'      => $imagePath, // Save the path to the database
        ]);

        $this->selectedConversation->touch(); // Update conversation timestamp

        // Reset the input fields after sending
        $this->reset(['newMessage', 'photo']);

        $this->loadMessages();
        $this->dispatch('message-sent');
    }

    public function loadMessages()
    {
        if ($this->selectedConversation) {
            $this->chatMessages = Message::where('conversation_id', $this->selectedConversation->id)
                ->with('user:id,name,profile_photo_path')
                ->orderBy('created_at', 'asc')
                ->get();
        }
    }

    public function render()
    {
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