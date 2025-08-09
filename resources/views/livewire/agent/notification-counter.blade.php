<div wire:poll.5s="getUnreadCount">
    {{-- This polls the `getUnreadCount` method every 5 seconds --}}
    
    @if($unreadCount > 0)
        <span class="absolute top-1 right-1 h-5 w-5 rounded-full bg-red-500 text-white text-xs flex items-center justify-center">
            {{ $unreadCount }}
        </span>
    @endif
</div>