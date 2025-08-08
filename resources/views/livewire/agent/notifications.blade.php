<div class="bg-white rounded-2xl shadow-sm p-6 sm:p-8">

    <!-- Header with Delete button -->
    <div class="flex justify-end mb-4">
        <button wire:click="deleteAll" wire:confirm="هل أنت متأكد من حذف جميع الإشعارات؟" class="flex items-center gap-1 px-3 py-1.5 text-[15.5px] font-medium text-[rgba(212,0,0,1)] bg-[rgba(204,204,204,0.16)] rounded-lg hover:bg-red-100 transition-colors">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
            <span>حذف الكل</span>
        </button>
    </div>

    <!-- Notifications List -->
    <div class="space-y-2">
        @forelse ($notifications as $notification)
            <div class="flex items-center justify-between p-4 rounded-lg hover:bg-gray-50 transition-colors">
                
                @if ($notification->data['status'] === 'active')
                    {{-- Approved Icon --}}
                    <div class="flex-shrink-0 w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                @else
                    {{-- Rejected Icon --}}
                    <div class="flex-shrink-0 w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center text-white">
                         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </div>
                @endif
                
                <div class="flex-grow mr-4 text-right">
                    <p class="text-sm text-gray-700">{{ $notification->data['message'] }}</p>
                    <div class="flex items-center justify-end gap-1.5 mt-2">
                        <span class="text-xs text-gray-400">{{ $notification->created_at->diffForHumans() }}</span>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-16">
                <p class="text-gray-500 font-medium">لا توجد إشعارات حالياً.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $notifications->links() }}
    </div>
</div>