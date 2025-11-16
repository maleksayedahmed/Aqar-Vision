@extends('layouts.app')

@section('title', __('common.choose_ad_license_type_title'))

@section('content')
@php
    $routePrefix = Auth::user() && Auth::user()->agent ? 'agent.ads.' : 'user.ads.';
@endphp

<main class="py-10 bg-[rgba(250,250,250,1)]">
    <section class="flex justify-center px-4 sm:px-6 lg:px-4">
        <div class="flex flex-col w-full lg:flex-row gap-4">

            <!-- Sidebar Navigation -->
            @if(Auth::user() && Auth::user()->agent)
                @include('partials.agent_sidebar')
            @else
                @include('partials.user_sidebar')
            @endif


            <!-- Pricing Section -->
            <section class="h-full w-full">
                <div class="">
                    <div class="bg-white rounded-2xl shadow-sm p-8">
                        <!-- Section Header -->
                        <div class="text-center mb-12">
                            <h2 class="text-[24.5px] font-bold text-[rgba(48,62,124,1)]">{{ __('common.choose_ad_license_type_title') }}</h2>
                            <p class="mt-4 text-[16.8px] max-w-2xl mx-auto text-[rgba(77,77,77,1)]">
                                {{ __('common.choose_ad_license_intro') }}
                            </p>
                        </div>

                        <!-- Pricing Cards Grid -->
                        <div class="flex flex-col items-center lg:flex-row lg:justify-center lg:items-start gap-8">

                            @forelse ($adPrices as $price)
                                <div class="w-full max-w-sm lg:w-[300px] border border-gray-200 rounded-xl p-6 flex flex-col text-center">
                                    <div class="mb-6 flex justify-center">
                                        @if($price->type == 'normal')
                                            <img src="{{ asset('images/normal ad.png') }}" alt="{{ __('common.standard') }}">
                                        @elseif($price->type == 'featured')
                                            <img src="{{ asset('images/second ad.png') }}" alt="{{ __('common.featured') }}">
                                        @else
                                            <img src="{{ asset('images/diamond ad.png') }}" alt="{{ __('common.exceptional') }}">
                                        @endif
                                    </div>
                                    <h3 class="text-[17.6px] font-medium text-[rgba(3,33,110,1)] mb-3">{{ $price->name }}</h3>
                                    <p class="text-[14.7px] text-[rgba(153,153,153,1)] font-semibold leading-relaxed flex-grow mb-6">
                                        {{ $price->description }}
                                    </p>
                                    <div class="mb-6 flex gap-2 items-center justify-center">
                                        <span class="text-[23.8px] font-semibold">{{ (int)$price->price }}</span>
                                        <img src="{{ asset('images/royal.png') }}" class="h-[20px] w-[20px]" alt="{{ __('common.sar_word') }}">
                                    </div>
                                    <div class="bg-[rgba(79,171,232,0.1)] border border-[rgba(79,171,232,1)] rounded-lg p-3 flex items-center justify-between mb-6">
                                        <span class="text-[11.8px]">{{ __('common.add_map_listing_option') }} (<span class="text-[rgba(79,171,232,1)]">+100 {{ __('common.sar_word') }}</span>)</span>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" value="" class="sr-only peer">
                                            <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-blue-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                                        </label>
                                    </div>
                                    <a href="{{ route($routePrefix . 'create.step1', $price) }}" class="w-full bg-[rgba(48,62,124,1)] text-[14.7px] text-white font-normal py-2 rounded-md hover:bg-opacity-90 transition-colors mt-auto">
                                        {{ __('common.subscribe_now') }}
                                    </a>
                                </div>
                            @empty
                                <div class="text-center py-10 col-span-full">
                                    <p class="text-gray-500">{{ __('common.no_packages_available') }}</p>
                                </div>
                            @endforelse

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
</main>

@endsection
