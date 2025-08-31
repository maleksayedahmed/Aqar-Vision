<div class="bg-white rounded-2xl shadow-sm p-6 sm:p-8" wire:poll.10s>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">الإشعارات</h2>
        <button wire:click="deleteAll" wire:confirm="هل أنت متأكد من حذف جميع الإشعارات؟" class="flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100">
            <span>حذف الكل</span>
        </button>
    </div>

    <div class="space-y-4">
        @forelse ($notifications as $notification)
            <div class="flex items-start gap-4 p-4 rounded-lg border {{ $notification->read_at ? 'border-gray-100' : 'border-blue-200 bg-blue-50' }}">
                
                @if ($notification->data['status'] === 'active')
                    <div class="flex-shrink-0 w-10 h-10 bg-green-100 text-green-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                @else
                    <div class="flex-shrink-0 w-10 h-10 bg-red-100 text-red-600 rounded-full flex items-center justify-center">
                         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </div>
                @endif
                
                <div class="flex-grow">
                    <p class="text-sm text-gray-800">{{ $notification->data['message'] }}</p>

                    {{-- ** THIS IS THE FIX: Show the rejection reason if it exists ** --}}
                    @if (!empty($notification->data['rejection_reason']))
                        <div class="mt-2 p-3 bg-red-50 border-l-4 border-red-400 text-red-700 text-sm rounded">
                            <p class="font-semibold">سبب الرفض:</p>
                            <p>{{ $notification->data['rejection_reason'] }}</p>
                        </div>
                    @endif

                    <div class="flex items-center gap-1.5 mt-2">
                        <span class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
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
