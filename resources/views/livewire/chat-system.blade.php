<main x-data="chatBox" 
      @chat-selected.window="scrollToBottom()" 
      @message-sent.window="scrollToBottom()"
      class="flex flex-col lg:flex-row-reverse justify-center bg-[rgba(250,250,250,1)] p-4 md:p-8 gap-[12px]"
      wire:poll.5s="loadMessages">

      <style>
        .space-y-8 > :not([hidden]) ~ :not([hidden]){
            margin-top: 12px !important;
        }
      </style>
    <!-- left-col (Chat Window) -->
    <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col w-full max-w-[844px]" dir="rtl">

        @if ($selectedConversation)
            <!-- Property Info Header -->
            <div class="bg-[rgba(249,250,252,1)] rounded p-4 flex flex-col md:flex-row justify-between items-center md:items-start gap-4 mb-8">
                <div class="flex flex-col items-center gap-4 flex-shrink-0">
                    <img src="{{ !empty($selectedConversation->ad->images) ? Storage::url($selectedConversation->ad->images[0]) : 'https://placehold.co/128x128/3B4A7A/ffffff?text=AD' }}" class="w-32 h-32 rounded object-cover" alt="Property Image">
                </div>

                <div class="flex-grow text-right flex flex-col w-full">
                    <div class="flex flex-col items-center sm:flex-row gap-2 sm:gap-8 mb-2">
                        <div class="flex items-center gap-2 text-[12.5px] font-semibold text-[rgba(26,26,26,1)]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[rgba(48,62,124,1)]" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                            <span>{{ $selectedConversation->ad->district->city->name }} - {{ $selectedConversation->ad->district->name }}</span>
                        </div>
                        <div class="flex items-center gap-0.5 text-[11px] text-[rgba(204,204,204,1)]">
                            <img src="{{ asset('images/clock.svg') }}" alt="">
                            <span>{{ $selectedConversation->ad->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col items-end gap-2 md:flex-row md:items-center md:justify-between">
                        <div class="w-full text-center md:text-right md:w-[300px]">
                            <h2 class="text-[18px] font-semibold text-[rgba(26,26,26,1)]] mb-1">{{ $selectedConversation->ad->title }}</h2>
                            <p class="text-xs text-[rgba(153,153,153,1)] mb-1 leading-relaxed">{{ Str::limit($selectedConversation->ad->description, 80) }}</p>
                        </div>
                        <p class="text-lg font-bold text-gray-800 whitespace-nowrap">{{ number_format($selectedConversation->ad->total_price) }} ريال</p>
                    </div>
                    <div class="flex items-center justify-center md:justify-start gap-2 text-sm text-gray-600 mt-2">
                        <span class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md"><img src="{{ asset('images/building.svg') }}" class="h-4 w-4"> {{ $selectedConversation->ad->propertyType->name }}</span>
                        <span class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md"><img src="{{ asset('images/bath.svg') }}" class="h-4 w-4"> {{ $selectedConversation->ad->bathrooms }} حمام</span>
                        <span class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md"><img src="{{ asset('images/bed.svg') }}" class="h-4 w-4"> {{ $selectedConversation->ad->rooms }} غرف نوم</span>
                    </div>
                </div>
            </div>

            <!-- Chat Messages -->
            <div x-ref="chatBox" class="flex-grow space-y-8 overflow-y-auto h-[500px] px-2">
                {{-- THE FIX: Loop over $chatMessages instead of $messages --}}
                @forelse ($chatMessages as $message)
                    @if ($message->user_id == auth()->id())
                        <!-- Outgoing Message -->
                        <div class="flex justify-end">
                            <div class="flex flex-col items-end">
                                <div class="bg-gray-100 text-gray-800 p-3 rounded-2xl rounded-br-none max-w-xs">
                                    <p class="text-right">{{ $message->body }}</p>
                                </div>
                                <span class="text-xs text-gray-400 mt-1.5 px-1">{{ $message->created_at->format('h:i A') }}</span>
                            </div>
                        </div>
                    @else
                        <!-- Incoming Message -->
                        <div class="flex justify-start items-end gap-3">
                            <img src="{{ $message->user->profile_photo_path ? Storage::url($message->user->profile_photo_path) : 'https://ui-avatars.com/api/?name='.urlencode($message->user->name).'&background=3B4A7A&color=fff' }}" alt="{{ $message->user->name }}" class="w-10 h-10 rounded-full object-cover self-start">
                            <div class="flex flex-col items-start">
                                <span class="text-sm text-gray-600 mb-1 px-1">{{ $message->user->name }}</span>
                                <div class="bg-[#3B4A7A] text-white p-3 rounded-2xl rounded-bl-none max-w-xs">
                                    <p class="text-right">{{ $message->body }}</p>
                                </div>
                                <span class="text-xs text-gray-400 mt-1.5 px-1">{{ $message->created_at->format('h:i A') }}</span>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="text-center text-gray-500 py-10">ابدأ المحادثة الآن!</div>
                @endforelse
            </div>

            <!-- Message Input -->
            <div class="mt-6 pt-4">
                <form wire:submit.prevent="sendMessage" class="bg-[rgba(249,250,252,1)] rounded-xl p-2 flex flex-row-reverse items-center gap-3">
                     <button type="submit" class="bg-[#3B4A7A] p-2.5 rounded-lg text-white flex-shrink-0">
                        <img src="{{ asset('images/send.svg') }}">
                     </button>
                     <button type="button" class="text-gray-500 p-2.5 flex-shrink-0">
                        <img src="{{ asset('images/camera.svg') }}">
                     </button>
                     <input type="text" wire:model.defer="newMessage" placeholder="اكتب رسالتك هنا" class="w-full bg-transparent focus:outline-none text-right placeholder-gray-400">
                </form>
            </div>
        @else
            <div class="flex h-full items-center justify-center text-gray-500">
                <p>الرجاء تحديد محادثة لعرض الرسائل.</p>
            </div>
        @endif
    </div>

    <!-- right-col (Message List) -->
    <div class="bg-white p-6 rounded-2xl shadow-lg w-full max-w-sm">
        <h2 class="text-[28px] font-medium text-right text-[rgba(48,62,124,1)] mb-8">رسائلي</h2>
        <div class="flex flex-col gap-4">
            @forelse ($conversations as $conversation)
                @php $otherUser = $conversation->otherUser(); @endphp
                <div wire:click="selectConversation({{ $conversation->id }})" class="{{ $selectedConversation?->id == $conversation->id ? 'bg-[rgba(249,250,252,1)]' : '' }} rounded-md p-2 pl-4 hover:bg-gray-100 cursor-pointer flex items-center justify-between" dir="rtl">
                    <div class="flex items-center gap-3">
                        <img src="{{ $otherUser->profile_photo_path ? Storage::url($otherUser->profile_photo_path) : 'https://ui-avatars.com/api/?name='.urlencode($otherUser->name).'&background=EBF4FF&color=3B4A7A' }}" alt="{{ $otherUser->name }}" class="w-[56px] h-[56px] rounded-lg object-cover">
                        <div>
                            <h3 class="font-medium text-[rgba(26,32,29,1)] text-sm">{{ $otherUser->name }}</h3>
                            <p class="text-xs {{ $conversation->unread_count > 0 ? 'text-black font-bold' : 'text-gray-400' }}">
                                {{ Str::limit(data_get($conversation, 'lastMessage.body'), 20) }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center flex-col gap-1">
                        @if ($conversation->unread_count > 0)
                            <span class="bg-[rgba(48,62,124,1)] text-white text-xs font-medium w-[20px] h-[20px] flex items-center justify-center rounded-full">{{ $conversation->unread_count }}</span>
                        @endif
                        <span class="text-[10px] text-[rgba(181,183,191,1)]">{{ data_get($conversation, 'lastMessage.created_at')?->diffForHumans() }}</span>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">لا توجد لديك محادثات.</p>
            @endforelse
        </div>
    </div>
</main>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('chatBox', () => ({
            init() {
                this.$nextTick(() => this.scrollToBottom());
                Livewire.on('chat-selected', () => { this.$nextTick(() => this.scrollToBottom()); });
                Livewire.on('message-sent', () => { this.$nextTick(() => this.scrollToBottom()); });
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