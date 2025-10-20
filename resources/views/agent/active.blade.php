{{-- resources/views/agent/active.blade.php --}}

@extends('layouts.agent')

@section('title', __('common.agent_home_title'))

@section('content')

    <main class="flex lg:px-20 px-4  flex-col items-center lg:min-h-screen pt-[60px] pb-8 lg:pb-[140px]">

        @if ($agent->user && $agent->user->is_active)
            <!-- Account Activation Section -->
            <div class="w-full mx-auto">
                <div
                    class="relative bg-[rgba(79,171,232,0.1)] rounded-2xl h-[300px] border-r-[3px] border-[rgba(255,224,51,1)] p-9 overflow-hidden">
                    <div class="flex flex-col items-center text-center">
                        <img src="{{ asset('images/bellactive.svg') }}">

                        {{-- DYNAMIC WELCOME MESSAGE --}}
                        <h2 class="text-[17px] font-bold text-[rgba(26,36,76,1)] mb-3 mt-7">
                            {{ __('common.account_activated') }}
                        </h2>

                        <p class="mb-8 text-[17px] text-[rgba(26,36,76,1)]">
                            {{ __('common.quick_dashboard_intro') }}
                        </p>

                        <a href="{{ route('agent.packages') }}"
                            class="bg-[rgba(79,171,232,1)] text-[19px] text-white py-3 px-8 rounded-lg hover:bg-[#4a95c8] transition-colors">
                            {{ __('common.subscribe_now') }}
                        </a>
                    </div>
                </div>
            </div>

            <section class="max-w-[1325px] w-full mx-auto py-12 lg:pt-[95px] px-0">

                <!-- The Hero Slider Component (The code inside this component is the same) -->
                <div x-data="{
                    activeSlide: 0,
                    slides: [
                        { headline: '{{ __('common.slider_text_1') }}', subheadline: '{{ __('common.slider_sub_1') }}' },
                        { headline: '{{ __('common.slider_text_2') }}', subheadline: '{{ __('common.slider_sub_2') }}' },
                        { headline: '{{ __('common.slider_text_3') }}', subheadline: '{{ __('common.slider_sub_3') }}' }
                    ]
                }" x-init="setInterval(() => { activeSlide = (activeSlide + 1) % slides.length }, 5000)"
                    class="relative rounded-2xl overflow-hidden bg-[rgba(236,238,249,1)] w-full">
                    <!-- Subtle background pattern -->
                    <div class="absolute bottom-0 left-0 opacity-40">
                        <svg width="400" height="400" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <pattern id="pattern-squares" x="0" y="0" width="20" height="20"
                                    patternUnits="userSpaceOnUse">
                                    <rect x="8" y="8" width="4" height="4" fill="#e0e7ff" />
                                </pattern>
                            </defs>
                            <rect x="0" y="0" width="100%" height="100%" fill="url(#pattern-squares)" />
                        </svg>
                    </div>

                    <!-- Main Content Grid -->
                    <div
                        class="relative grid grid-cols-1 lg:grid-cols-2 items-center gap-0 lg:gap-8 py-6 px-4 md:py-[60px] md:px-[65px] z-10">

                        <!-- Text Content Column -->
                        <div class="flex flex-col items-center lg:items-start gap-y-8 text-center lg:text-right">
                            <!-- Logo -->
                            <img src="images/logo.png" class="w-[70px] h-[60px]" alt="logo">

                            <!-- Headline Text Container -->
                            <div class="relative min-h-[120px] md:min-h-[140px] w-full">
                                <template x-for="(slide, index) in slides" :key="index">
                                    <div x-show="activeSlide === index"
                                        x-transition:enter="transition ease-out duration-500"
                                        x-transition:enter-start="opacity-0 transform -translate-y-4"
                                        x-transition:enter-end="opacity-100 transform translate-y-0"
                                        x-transition:leave="transition ease-in duration-300"
                                        x-transition:leave-start="opacity-100 transform translate-y-0"
                                        x-transition:leave-end="opacity-0 transform translate-y-4"
                                        class="absolute w-full space-y-2">
                                        <h1 class="text-2xl md:text-3xl font-bold text-slate-800" x-text="slide.headline">
                                        </h1>
                                        <p class="text-2xl md:text-3xl font-bold">
                                            <span class="text-slate-700">{{ __('common.with') }}</span>
                                            <span class="text-indigo-600" x-text="slide.subheadline.split(' ')[1]"></span>
                                        </p>
                                    </div>
                                </template>
                            </div>

                            <!-- Slider Pagination Dots -->
                            <div class="flex gap-x-2 items-center self-center lg:self-end lg:-ml-[8%]">
                                <template x-for="(slide, index) in slides" :key="index">
                                    <button @click="activeSlide = index"
                                        class="h-1.5 rounded-full transition-all duration-300"
                                        :class="{
                                            'bg-indigo-600 w-8': activeSlide ===
                                                index,
                                            'bg-slate-300 w-1.5 hover:bg-slate-400': activeSlide !== index
                                        }"></button>
                                </template>
                            </div>
                        </div>

                        <!-- Image Column -->
                        <div class="hidden lg:flex relative justify-center items-center h-full min-h-[250px] lg:min-h-0">
                            <img src="images/home.png" alt="Modern house with red roof"
                                class="relative lg:absolute mt-8 lg:mt-[150px] lg:-ml-[210px] w-[400px] sm:w-[300px] lg:w-[380px] h-auto object-contain">
                        </div>

                    </div>
                </div>

            </section>
        @else
            <div class="w-full max-w-5xl mx-auto">
                <div class="bg-[rgba(203,84,75,1)] h-[100px] text-white p-4 sm:p-5 rounded-2xl flex items-center">
                    <div class="flex items-center gap-6 w-full">
                        <div
                            class="w-7 h-7 flex-shrink-0 flex items-center justify-center border-2 border-white/50 rounded-full">
                            <span class="font-mono font-bold text-lg italic">i</span>
                        </div>
                        <div>
                            <span class="hidden sm:inline font-bold">{{ __('common.alert') }}</span>
                            <p class="text-sm sm:text-base">
                                {{ __('common.account_not_activated_yet') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </main>
@endsection
