<div class="bg-white rounded-2xl shadow-sm p-6 sm:p-8" wire:poll.10s>

    <!-- Header with Delete button -->
    <div class="flex justify-end mb-4">
        <button wire:click="deleteAll" wire:confirm="{{ __('common.confirm_delete_all_notifications') }}"
            class="flex items-center gap-1 px-3 py-1.5 text-[15.5px] font-medium text-[rgba(212,0,0,1)] bg-[rgba(204,204,204,0.16)] rounded-lg hover:bg-red-100 transition-colors">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                    clip-rule="evenodd"></path>
            </svg>
            <span>{{ __('common.delete_all') }}</span>
        </button>
    </div>

    <!-- Notifications List -->
    <div class="space-y-2">
        @forelse ($notifications as $notification)
            <div class="flex items-center justify-between p-4 rounded-lg hover:bg-gray-50 transition-colors">

                @if (isset($notification->data['invitation_id']))
                    @php
                        $invitation = \App\Models\AgentInvitation::find($notification->data['invitation_id']);
                    @endphp
                    @if ($invitation && $invitation->status === 'pending')
                        <div
                            class="flex-shrink-0 w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.5 21.75c-2.676 0-5.216-.584-7.5-1.654z" />
                            </svg>
                        </div>
                        <div class="flex-grow mr-4 text-right">
                            <p class="text-sm text-gray-800">{{ $notification->data['message'] }}</p>
                            <div class="flex items-center gap-2 mt-2">
                                <a href="{{ route('agent.invitations.accept', $invitation) }}"
                                    class="btn btn-sm btn-success">{{ __('common.accept') }}</a>
                                <a href="{{ route('agent.invitations.reject', $invitation) }}"
                                    class="btn btn-sm btn-danger">{{ __('common.reject') }}</a>
                            </div>
                            <div class="flex items-center gap-1.5 mt-2">
                                <span
                                    class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @elseif(isset($notification->data['status']) && $notification->data['status'] === 'cancelled')
                        <div
                            class="flex-shrink-0 w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"></path>
                            </svg>
                        </div>
                        <div class="flex-grow mr-4 text-right">
                            <p class="text-sm text-gray-800">{{ $notification->data['message'] }}</p>
                            <div class="flex items-center gap-1.5 mt-2">
                                <span
                                    class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endif
                @elseif ($notification->data['status'] === 'active')
                    {{-- Approved Icon --}}
                    <div
                        class="flex-shrink-0 w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <div class="flex-grow mr-4 text-right">
                        <p class="text-sm text-gray-800">{{ $notification->data['message'] }}</p>
                        <div class="flex items-center gap-1.5 mt-2">
                            <span class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @else
                    {{-- Rejected Icon --}}
                    <div
                        class="flex-shrink-0 w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <div class="flex-grow mr-4 text-right">
                        <p class="text-sm text-gray-800">{{ $notification->data['message'] }}</p>

                        @if (!empty($notification->data['rejection_reason']))
                            <div class="mt-2 p-3 bg-red-50 border-l-4 border-red-400 text-red-700 text-sm rounded">
                                <p class="font-semibold">{{ __('common.rejection_reason') }}</p>
                                <p>{{ $notification->data['rejection_reason'] }}</p>
                            </div>
                        @endif

                        <div class="flex items-center gap-1.5 mt-2">
                            <span class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <div class="text-center py-16">
                <p class="text-gray-500 font-medium">{{ __('common.no_notifications') }}</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $notifications->links() }}
    </div>
</div>
