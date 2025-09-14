<?php

namespace App\Livewire\Agency;

use App\Models\Agent;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AgencyChatSystem extends Component
{
    use WithFileUploads;

    public $agency;
    public $conversations;
    public $selectedConversation;
    public $chatMessages;
    public $newMessage;
    public $photo;
    public $agents;

    public function mount($conversationId = null)
    {
        $this->agency = Auth::user()->agency;

        // Explicitly query for agents to bypass any relationship issues
        $agentModels = Agent::where('agency_id', $this->agency->id)->get();

        $agentUserIds = $agentModels->pluck('user_id')->filter();
        $this->agents = User::whereIn('id', $agentUserIds)->get();

        $this->loadConversations();

        if ($conversationId) {
            $this->selectConversation($conversationId);
        } else {
            $firstWithConversation = $this->conversations->first(function ($item) {
                return $item->conversation !== null;
            });

            if ($firstWithConversation) {
                $this->selectConversation($firstWithConversation->conversation->id);
            }
        }
    }

    public function loadConversations()
    {
        $agencyUserId = Auth::id();
        $agentUsers = $this->agents;
        $agentUserIds = $agentUsers->pluck('id');

        $conversations = Conversation::where(function ($query) use ($agencyUserId, $agentUserIds) {
            $query->where('sender_id', $agencyUserId)->whereIn('receiver_id', $agentUserIds);
        })
            ->orWhere(function ($query) use ($agencyUserId, $agentUserIds) {
                $query->whereIn('sender_id', $agentUserIds)->where('receiver_id', $agencyUserId);
            })
            ->with(['lastMessage', 'sender', 'receiver'])
            ->withCount(['messages as unread_count' => function ($query) {
                $query->where('is_read', false)->where('user_id', '!=', auth()->id());
            }])
            ->get()
            ->keyBy(function ($item) use ($agencyUserId) {
                return $item->sender_id == $agencyUserId ? $item->receiver_id : $item->sender_id;
            });

        $chatListItems = $agentUsers->map(function ($agentUser) use ($conversations) {
            $conversation = $conversations->get($agentUser->id);

            $chatListItem = new \stdClass();
            $chatListItem->user = $agentUser;
            $chatListItem->conversation = $conversation;
            $chatListItem->updated_at = optional($conversation)->updated_at ?? $agentUser->created_at;

            return $chatListItem;
        });

        $this->conversations = $chatListItems->sortByDesc('updated_at');
    }

    public function selectConversation($conversationId)
    {
        $this->selectedConversation = Conversation::with(['ad.district.city', 'ad.propertyType'])->findOrFail($conversationId);

        Message::where('conversation_id', $conversationId)
            ->where('user_id', '!=', auth()->id())
            ->update(['is_read' => true]);

        $this->loadMessages();
        $this->reset(['newMessage', 'photo']);
        $this->dispatch('chat-selected');
    }

    public function selectAgent($agentId)
    {
        if (!$this->agents->contains('id', $agentId)) {
            return;
        }

        $conversation = Conversation::firstOrCreate(
            [
                'sender_id' => auth()->id(),
                'receiver_id' => $agentId,
            ],
            []
        );

        $this->loadConversations();
        $this->selectConversation($conversation->id);
    }

    public function sendMessage()
    {
        $this->validate([
            'newMessage' => 'required_without:photo|nullable|string|max:1000',
            'photo'      => 'required_without:newMessage|nullable|image|max:2048',
        ]);

        if (!$this->selectedConversation) {
            return;
        }

        $imagePath = null;
        if ($this->photo) {
            $imagePath = $this->photo->store('chat-images', 'public');
        }

        Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'user_id'         => auth()->id(),
            'body'            => $this->newMessage,
            'image_path'      => $imagePath,
        ]);

        $this->selectedConversation->touch();

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
        $this->loadConversations();
        
        return view('livewire.agency.agency-chat-system')->layout('agency.layouts.app');
    }
}
