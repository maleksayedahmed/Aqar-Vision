@extends('layouts.app')

@section('title', __('common.favorites'))

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
    <main class="py-10 bg-[rgba(250,250,250,1)]">
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4">
            <div class="flex flex-col lg:flex-row gap-8">

                @auth
                    @include('partials.user_sidebar')
                @endauth

                <!-- Main Content -->
                <div class="flex-1">
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h1 class="text-2xl font-bold text-slate-800">{{ __('common.favorites') }}</h1>
                            <div class="text-sm text-gray-500">
                                {{ $favorites->total() }} {{ __('common.properties_word') }}
                            </div>
                        </div>

                        @if ($favorites->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach ($favorites as $ad)
                                    <div
                                        class="bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300">
                                        <div class="relative">
                                            <a href="{{ route('properties.show', $ad->id) }}">
                                                <img src="{{ !empty($ad->images) ? Storage::url($ad->images[0]) : 'https://placehold.co/400x300' }}"
                                                    class="w-full h-48 object-cover rounded-t-lg" alt="{{ $ad->title }}">
                                            </a>
                                            <div
                                                class="absolute top-2 left-2 bg-white text-[rgba(48,62,124,1)] text-xs font-medium px-2 py-1 rounded">
                                                {{ $ad->listing_purpose == 'rent' ? __('common.rent') : __('common.sale') }}
                                            </div>
                                            <button
                                                class="favorite-btn absolute top-2 right-2 bg-[rgba(255,255,255,0.27)] p-1.5 rounded-lg hover:shadow"
                                                data-ad-id="{{ $ad->id }}" data-favorited="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500"
                                                    fill="currentColor" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="p-4 space-y-3">
                                            <div
                                                class="flex justify-between items-center text-xs text-[rgba(204,204,204,1)]">
                                                <span class="flex items-center gap-0.5 font-semibold text-black">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4 text-[rgba(48,62,124,1)]" viewBox="0 0 20 20"
                                                        fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 20l-4.95-6.05a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    {{ $ad->district?->city?->name }} - {{ $ad->district?->name }}
                                                </span>
                                                <span class="flex items-center gap-0.5">
                                                    <img src="{{ asset('images/clock.svg') }}">
                                                    {{ $ad->created_at->format('d/m/Y') }}
                                                </span>
                                            </div>
                                            <div class="space-y-1.5">
                                                <h3 class="text-lg font-bold text-slate-800 leading-tight">
                                                    {{ Str::limit($ad->title, 60) }}
                                                </h3>
                                                <p class="text-xs text-slate-500">
                                                    {{ Str::limit($ad->description, 40) }}
                                                </p>
                                            </div>
                                            <div class="flex gap-2 text-sm">
                                                <span
                                                    class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md">
                                                    <img src="{{ asset('images/building.svg') }}" class="h-4 w-4">
                                                    {{ $ad->propertyType?->name }}
                                                </span>
                                                <span
                                                    class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md">
                                                    <img src="{{ asset('images/bath.svg') }}" class="h-4 w-4">
                                                    {{ $ad->bathrooms }} {{ __('common.bathroom_word') }}
                                                </span>
                                                <span
                                                    class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md">
                                                    <img src="{{ asset('images/bed.svg') }}" class="h-4 w-4">
                                                    {{ $ad->rooms }} {{ __('common.bedrooms') }}
                                                </span>
                                            </div>
                                            <div
                                                class="border-t border-gray-100 pt-4 mt-4 flex justify-between items-center">
                                                <p class="text-lg font-bold text-indigo-700">
                                                    {{ number_format($ad->total_price) }}
                                                    <span
                                                        class="text-xs font-medium text-slate-500">{{ __('common.sar') }}</span>
                                                </p>
                                                <a href="{{ route('properties.show', $ad->id) }}"
                                                    class="bg-[rgba(48,62,124,1)] text-white text-sm font-semibold px-6 py-2.5 rounded-lg hover:bg-indigo-800 transition-colors">
                                                    {{ __('common.view_details') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            @if ($favorites->hasPages())
                                <div class="mt-8">
                                    {{ $favorites->links() }}
                                </div>
                            @endif
                        @else
                            <div class="text-center py-12">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-24 w-24 text-gray-300"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>
                                <h3 class="mt-4 text-lg font-medium text-gray-900">{{ __('common.no_favorites') }}</h3>
                                <p class="mt-2 text-sm text-gray-500">{{ __('common.start_adding_favorites') }}</p>
                                <div class="mt-6">
                                    <a href="{{ route('properties.search') }}"
                                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[rgba(48,62,124,1)] hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        {{ __('common.browse_properties') }}
                                    </a>
                                </div>
                            </div>
                        @endif
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
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
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
                                if (!data.is_favorited && window.location.pathname.includes(
                                        'favorites')) {
                                    this.closest('.bg-white').style.animation =
                                        'fadeOut 0.3s ease-out';
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
            from {
                opacity: 1;
                transform: scale(1);
            }

            to {
                opacity: 0;
                transform: scale(0.95);
            }
        }
    </style>
@endpush
