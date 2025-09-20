<div wire:poll.5s="getUnreadCount">
    @if($unreadCount > 0)
        <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full border-2 border-white"></span>
    @endif
</div>