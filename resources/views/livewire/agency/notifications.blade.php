<div class="bg-white rounded-2xl shadow-sm" wire:poll.10s>
    <!-- Header -->
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Notifications
        </h3>
        <button wire:click="deleteAll" wire:confirm="Are you sure you want to delete all notifications?" class="text-sm font-medium text-red-600 hover:text-red-500">
            Delete All
        </button>
    </div>

    <!-- Notifications List -->
    <div class="divide-y divide-gray-200">
        @forelse ($notifications as $notification)
            <div class="p-4 flex items-start hover:bg-gray-50">
                <div class="flex-shrink-0">
                    @if (isset($notification->data['status']) && $notification->data['status'] === 'accepted')
                        <span class="inline-flex justify-center items-center w-10 h-10 rounded-full bg-green-100">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </span>
                    @elseif (isset($notification->data['status']) && $notification->data['status'] === 'rejected')
                        <span class="inline-flex justify-center items-center w-10 h-10 rounded-full bg-red-100">
                             <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </span>
                    @else
                        <span class="inline-flex justify-center items-center w-10 h-10 rounded-full bg-gray-100">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"></path></svg>
                        </span>
                    @endif
                </div>
                <div class="ms-4 flex-grow">
                    <p class="text-sm font-medium text-gray-900">{{ $notification->data['message'] ?? 'You have a new notification.' }}</p>
                    <p class="text-sm text-gray-500 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                </div>
            </div>
        @empty
            <div class="text-center py-16">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No notifications</h3>
                <p class="mt-1 text-sm text-gray-500">You don't have any notifications yet.</p>
            </div>
        @endforelse
    </div>

    @if($notifications->hasPages())
        <div class="bg-gray-50 px-4 py-3">
            {{ $notifications->links() }}
        </div>
    @endif
</div>
