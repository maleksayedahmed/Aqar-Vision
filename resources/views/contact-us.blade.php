@extends('layouts.app')

@section('title', __('common.contact_us'))

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
<main class="py-10 bg-[rgba(250,250,250,1)]">
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4">
        <div class="flex flex-col lg:flex-row gap-8">



            <!-- Main Content -->
            <div class="max-w-7xl mx-auto pb-10">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-[24.5px] font-semibold text-[rgba(48,62,124,1)]">{{ __('common.contact_us') }}</h2>
            <p class="mt-3 text-[16.8px] text-[rgba(77,77,77,1)]">{{ __('common.contact_subtitle') }}</p>
        </div>

        <!-- Main Content Grid -->
        <div class="flex flex-col lg:flex-row gap-8 items-start">

            <!-- Right Side: Contact Info -->
            <div class="font-madani bg-white w-full lg:w-[307px] lg:flex-shrink-0 rounded-2xl shadow-sm p-8">
                <h3 class="text-[17px] font-bold text-[rgba(48,62,124,1)] mb-8">{{ __('common.contact_info') }}</h3>
                    <div class="space-y-10">
                        <!-- Phone -->
                        <div class="text-center">
                            <p class="flex items-center gap-2 text-[rgba(48,62,124,1)]">
                                <img src="{{ asset('images/call.svg') }}" alt="">
                                <span>{{ __('common.phone_number') }}</span>
                            </p>
                            <p class="flex items-center gap-2 text-sky-500 mt-2">
                                <span>0509777655</span>
                                <button>
                                    <img src="{{ asset('images/copy.svg') }}" alt="">
                                </button>
                            </p>
                        </div>
                         <!-- Email -->
                        <div class="text-center">
                             <p class="flex items-center gap-2 text-[rgba(48,62,124,1)]">
                                <img src="{{ asset('images/email.svg') }}" alt="">
                                <span>{{ __('common.email') }}</span>
                            </p>
                            <p class="flex items-center gap-2 text-sky-500 mt-2">
                                <span>aqarvition@gmail.com</span>
                                <button>
                                    <img src="{{ asset('images/copy.svg') }}" alt="">
                                </button>
                            </p>
                        </div>
                         <!-- Location -->
                        <div class="">
                            <p class="flex items-center gap-2 text-[rgba(48,62,124,1)]">
                                <img src="{{ asset('images/location-contact.svg') }}" alt="">
                                <span>{{ __('common.location') }}</span>
                            </p>
                            <p class="text-sky-500 mt-2">{{ __('common.riyadh') }}</p>
                             <p class="flex items-center gap-2 text-sky-500 mt-1 text-sm">
                                <span>{{ __('common.address') }}</span>
                                <button>
                                <img src="{{ asset('images/link.svg') }}" alt="">
                                </button>
                            </p>
                        </div>
                    </div>
                    <!-- Social Media -->
                    <div class="text-center gap-[12px] mt-10">
                        <p class=" text-gray-[rgba(26,26,26,1)] mb-4 text-[14px]">{{ __('common.follow_us') }}</p>
                        <div class="flex flex-row-reverse items-center justify-center gap-4">
                            <a href="#" class="text-gray-700 hover:text-black transition-colors">
                                <img src="{{ asset('images/youtube-dark.svg') }}" alt="">
                            </a>
                            <a href="#" class="text-gray-700 hover:text-black transition-colors">
                                <img src="{{ asset('images/tiktok-dark.svg') }}" alt="">
                            </a>
                            <a href="#" class="text-gray-700 hover:text-black transition-colors">
                                <img src="{{ asset('images/insta-dark.svg') }}" alt="">
                            </a>
                            <a href="#" class="text-gray-700 hover:text-black transition-colors">
                                <img src="{{ asset('images/fb-dark.svg') }}" alt="">
                            </a>

                        </div>
                    </div>
            </div>

            <!-- Left Side: Form -->
            <div class="font-madani bg-white w-full rounded-2xl shadow-sm p-8">
                {{-- Make sure the form points to the correct POST route --}}
                <form method="POST" action="{{ route('agent.contact.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                    @csrf
                    <!-- Inputs... (make sure they have `name` attributes) -->
                     <!-- Name -->
                        <div>
                            <label for="name" class="block text-[14.2px] font-medium text-[rgba(26,26,26,1)] mb-2">{{ __('common.name') }}</label>
                            <input type="text" id="name" name="name" placeholder="{{ __('common.enter_name') }}" class="text-[14.2px] w-full bg-[#F9F9F9] text-gray-500 rounded-[12px] py-3 px-5 focus:outline-none focus:ring-2 focus:ring-[#303F7C]">
                        </div>
                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-[14.2px] font-medium text-[rgba(26,26,26,1)] mb-2">{{ __('common.phone_number') }}</label>
                            <div class="relative">
                                <input type="tel" id="phone" name="phone" placeholder="{{ __('common.enter_phone') }}" class="text-[14.2px] w-full bg-[#F9F9F9] text-gray-500 rounded-[12px] py-3 px-5 text-right pr-14 focus:outline-none focus:ring-2 focus:ring-[#303F7C]">
                                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                    <img src="{{ asset('images/saudi_flag.png') }}" alt="Saudi Flag" class="w-6 h-auto">
                                </div>
                            </div>
                        </div>
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-[14.2px] font-medium text-[rgba(26,26,26,1)] mb-2">{{ __('common.email') }}</label>
                            <input type="email" id="email" name="email" placeholder="{{ __('common.enter_email') }}" class="text-[14.2px] w-full bg-[#F9F9F9] text-gray-500 rounded-[12px] py-3 px-5 focus:outline-none focus:ring-2 focus:ring-[#303F7C]">
                        </div>
                         <!-- Service Type -->
                        <div>
                            <label for="service_type" class="block text-[14.2px] text-[rgba(26,26,26,1)] mb-2">{{ __('common.service_type') }}</label>
                            <input type="text" id="service_type" name="service_type" placeholder="{{ __('common.choose_service') }}" class="text-[14.2px] w-full bg-[#F9F9F9] text-gray-500 rounded-[12px] py-3 px-5 focus:outline-none focus:ring-2 focus:ring-[#303F7C]">
                        </div>
                        <!-- Message -->
                        <div class="md:col-span-2">
                            <label for="message" class="block text-[14.2px] text-[rgba(26,26,26,1)] mb-2">{{ __('common.message_optional') }}</label>
                            <textarea id="message" name="message" rows="5" placeholder="{{ __('common.enter_message') }}" class="text-[14.2px] w-full bg-[#F9F9F9] text-gray-500 rounded-3xl py-3 px-5 focus:outline-none focus:ring-2 focus:ring-[#303F7C]"></textarea>
                        </div>
                    <!-- Submit Button -->
                    <div class="md:col-span-2 text-center pt-3">
                        <button type="submit" class="text-[17px] bg-[rgba(48,62,124,1)] text-white py-3 px-12 rounded-lg hover:bg-opacity-90 transition-colors shadow-sm flex items-center justify-center gap-2 mx-auto">
                            <img src="{{ asset('images/send-white.svg') }}" class="w-[18px]" alt="">
                            <span>{{ __('common.send') }}</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Favorite functionality
    document.querySelectorAll('.favorite-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const adId = this.dataset.adId;
            const isFavorited = this.dataset.favorited === 'true';

            // Optimistic UI update
            updateFavoriteButton(this, !isFavorited);

            fetch('/favorites/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    ad_id: adId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    this.dataset.favorited = data.is_favorited;
                    updateFavoriteButton(this, data.is_favorited);

                    // If removing from favorites page, remove the card
                    if (!data.is_favorited && window.location.pathname.includes('favorites')) {
                        this.closest('.bg-white').style.animation = 'fadeOut 0.3s ease-out';
                        setTimeout(() => {
                            this.closest('.bg-white').remove();
                        }, 300);
                    }
                } else {
                    // Revert optimistic update on error
                    updateFavoriteButton(this, isFavorited);
                    this.dataset.favorited = isFavorited;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Revert optimistic update on error
                updateFavoriteButton(this, isFavorited);
                this.dataset.favorited = isFavorited;
            });
        });
    });

    function updateFavoriteButton(button, isFavorited) {
        const svg = button.querySelector('svg');
        if (isFavorited) {
            svg.setAttribute('fill', 'currentColor');
            svg.classList.remove('text-[rgba(242,242,242,1)]');
            svg.classList.add('text-red-500');
        } else {
            svg.setAttribute('fill', 'none');
            svg.classList.remove('text-red-500');
            svg.classList.add('text-[rgba(242,242,242,1)]');
        }
    }
});
</script>

<style>
@keyframes fadeOut {
    from { opacity: 1; transform: scale(1); }
    to { opacity: 0; transform: scale(0.95); }
}
</style>
@endpush
