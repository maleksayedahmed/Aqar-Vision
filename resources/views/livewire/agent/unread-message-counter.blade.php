<div wire:poll.5s="getUnreadMessageCount">
    @if($unreadCount > 0)
        <span class="absolute top-0 right-0 flex h-3 w-3">
            <span class="relative inline-flex rounded-full h-2 w-2 bg-yellow-400 ring-1 ring-white"></span>
        </span>
    @endif
</div>
