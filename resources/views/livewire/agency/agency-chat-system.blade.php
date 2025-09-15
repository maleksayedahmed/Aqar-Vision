<main x-data="chatBox" 
      @chat-selected.window="scrollToBottom()" 
      @message-sent.window="scrollToBottom()"
      class="flex flex-col lg:flex-row-reverse justify-center bg-[rgba(250,250,250,1)] p-4 md:p-8 gap-[12px]"
      wire:poll.5s="loadMessages">

    <!-- left-col (Chat Window) -->
    <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col w-full max-w-[844px]" dir="rtl">

        @if ($selectedConversation)
            {{-- Chat Header --}}
            <div class="flex items-center gap-4 mb-6 pb-4 border-b">
                <img src="{{ optional($selectedConversation->otherUser())->profile_photo_path ? Storage::url(optional($selectedConversation->otherUser())->profile_photo_path) : 'https://ui-avatars.com/api/?name='.urlencode(optional($selectedConversation->otherUser())->name).'&background=3B4A7A&color=fff' }}" alt="{{ optional($selectedConversation->otherUser())->name }}" class="w-12 h-12 rounded-full object-cover">
                <h2 class="text-lg font-semibold">{{ $selectedConversation->otherUser()->name }}</h2>
            </div>

            <!-- Chat Messages -->
            <div x-ref="chatBox" class="flex-grow space-y-4 overflow-y-auto h-[400px] px-2">
                @forelse ($chatMessages as $message)
                    @if ($message->user_id == auth()->id())
                        <!-- Outgoing Message -->
                        <div class="flex justify-end">
                            <div class="flex flex-col items-end max-w-lg">
                                @if ($message->body)
                                <div class="bg-gray-100 text-gray-800 p-3 rounded-2xl rounded-br-none">
                                    <p class="text-right whitespace-pre-wrap">{{ $message->body }}</p>
                                </div>
                                @endif
                                @if ($message->image_path)
                                <div class="mt-2">
                                    <a href="{{ Storage::url($message->image_path) }}" target="_blank">
                                        <img src="{{ Storage::url($message->image_path) }}" class="rounded-lg object-cover" style="max-height: 200px; max-width: 100%;">
                                    </a>
                                </div>
                                @endif
                                <span class="text-xs text-gray-400 mt-1.5 px-1">{{ $message->created_at->format('h:i A') }}</span>
                            </div>
                        </div>
                    @else
                        <!-- Incoming Message -->
                        <div class="flex justify-start items-end gap-3">
                            <img src="{{ optional($message->user)->profile_photo_path ? Storage::url($message->user->profile_photo_path) : 'https://ui-avatars.com/api/?name='.urlencode(optional($message->user)->name).'&background=3B4A7A&color=fff' }}" alt="{{ optional($message->user)->name }}" class="w-10 h-10 rounded-full object-cover self-start flex-shrink-0">
                            <div class="flex flex-col items-start max-w-lg">
                                <span class="text-sm text-gray-600 mb-1 px-1">{{ optional($message->user)->name }}</span>
                                @if ($message->body)
                                <div class="bg-[#3B4A7A] text-white p-3 rounded-2xl rounded-bl-none">
                                    <p class="text-right whitespace-pre-wrap">{{ $message->body }}</p>
                                </div>
                                @endif
                                @if ($message->image_path)
                                <div class="mt-2">
                                     <a href="{{ Storage::url($message->image_path) }}" target="_blank">
                                        <img src="{{ Storage::url($message->image_path) }}" class="rounded-lg object-cover" style="max-height: 200px; max-width: 100%;">
                                    </a>
                                </div>
                                @endif
                                <span class="text-xs text-gray-400 mt-1.5 px-1">{{ $message->created_at->format('h:i A') }}</span>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="text-center text-gray-500 py-10">Select an agent to start chatting.</div>
                @endforelse
            </div>

            <!-- Message Input Area -->
            <div class="mt-6 pt-4 border-t">
                <div wire:loading wire:target="photo" class="text-sm text-gray-500 mb-2">Uploading image...</div>
                @if ($photo && !$errors->has('photo'))
                <div class="relative inline-block w-32 h-32 mb-4 p-2 bg-gray-100 rounded-lg">
                    <img src="{{ $photo->temporaryUrl() }}" class="w-full h-full rounded-md object-cover">
                    <button wire:click.prevent="$set('photo', null)" class="absolute -top-2 -right-2 bg-red-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-sm font-bold leading-none">&times;</button>
                </div>
                @endif
                
                <form wire:submit="sendMessage" class="bg-[rgba(249,250,252,1)] rounded-xl p-2 flex flex-row-reverse items-center gap-3">
                     <button type="submit" class="bg-[#3B4A7A] p-2.5 rounded-lg text-white flex-shrink-0" wire:loading.attr="disabled">
                        <img src="{{ asset('images/send.svg') }}">
                     </button>
                     
                     <label for="photo-upload" class="text-gray-500 p-2.5 flex-shrink-0 cursor-pointer">
                        <img src="{{ asset('images/camera.svg') }}">
                     </label>
                     <input type="file" wire:model.live="photo" id="photo-upload" class="hidden">
                     
                     <input type="text" wire:model="newMessage" wire:keydown.enter.prevent="sendMessage" placeholder="Type your message here" class="w-full bg-transparent focus:outline-none text-right placeholder-gray-400">
                </form>

                @error('photo') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                @error('newMessage') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
        @else
            <div class="flex h-full items-center justify-center text-gray-500">
                <p>Please select a conversation to view messages.</p>
            </div>
        @endif
    </div>

    <!-- right-col (Agent List) -->
    <div class="bg-white p-6 rounded-2xl shadow-lg w-full max-w-sm">
        <h2 class="text-[28px] font-medium text-right text-[rgba(48,62,124,1)] mb-8">Agents</h2>
        <div class="flex flex-col gap-4">

            @forelse ($conversations as $item)
                @php
                    $agentUser = $item->user;
                    $conversation = $item->conversation;
                @endphp
                <div wire:click="selectAgent({{ $agentUser->id }})" class="{{ ($selectedConversation && $conversation && $selectedConversation->id == $conversation->id) ? 'bg-[rgba(249,250,252,1)]' : '' }} rounded-md p-2 pl-4 hover:bg-gray-100 cursor-pointer flex items-center justify-between" dir="rtl">
                    <div class="flex items-center gap-3">
                        <img src="{{ $agentUser->profile_photo_path ? Storage::url($agentUser->profile_photo_path) : 'https://ui-avatars.com/api/?name='.urlencode($agentUser->name).'&background=EBF4FF&color=3B4A7A' }}" alt="{{ $agentUser->name }}" class="w-[56px] h-[56px] rounded-lg object-cover">
                        <div>
                            <h3 class="font-medium text-[rgba(26,32,29,1)] text-sm">{{ $agentUser->name }}</h3>
                            <p class="text-xs {{ $conversation && $conversation->unread_count > 0 ? 'text-black font-bold' : 'text-gray-400' }}">
                                @if($conversation && data_get($conversation, 'lastMessage.image_path') && !data_get($conversation, 'lastMessage.body'))
                                    <span class="text-gray-500">[Image]</span>
                                @elseif($conversation && $conversation->lastMessage)
                                    {{ Str::limit(data_get($conversation, 'lastMessage.body'), 20) }}
                                @else
                                    &nbsp;
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center flex-col gap-1">
                        @if ($conversation && $conversation->unread_count > 0)
                            <span class="bg-[rgba(48,62,124,1)] text-white text-xs font-medium w-[20px] h-[20px] flex items-center justify-center rounded-full">{{ $conversation->unread_count }}</span>
                        @endif
                        <span class="text-[10px] text-[rgba(181,183,191,1)]">{{ $conversation ? (data_get($conversation, 'lastMessage.created_at')?->diffForHumans()) : '' }}</span>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">No agents found in this agency.</p>
            @endforelse
        </div>
    </div>
</main>

@push('scripts')
<script>
    console.log('Alpine version:', Alpine.version);
    document.addEventListener('alpine:init', () => {
        Alpine.data('chatBox', () => ({
            init() {
                this.$nextTick(() => this.scrollToBottom());
                Livewire.on('chat-selected', () => { this.$nextTick(() => this.scrollToBottom()); });
                Livewire.on('message-sent', () => { this.$nextTick(() => this.scrollToBottom()); });

                Livewire.on('message-sent', () => {
                    const fileInput = document.getElementById('photo-upload');
                    if (fileInput) {
                        fileInput.value = '';
                    }
                });
            },
            scrollToBottom() {
                if (this.$refs.chatBox) {
                    this.$refs.chatBox.scrollTop = this.$refs.chatBox.scrollHeight;
                }
            }
        }));
    });
</script>
@endpush
