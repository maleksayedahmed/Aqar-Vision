@extends('layouts.app') {{-- Use the main app layout --}}

@section('title', __('common.about_us'))

@section('content')

<main class="py-10 bg-gray-50">
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4">
        <div class="flex flex-col lg:flex-row gap-4">

            <!-- User Sidebar Navigation -->
            @auth
                @include('partials.user_sidebar')
            @endauth

            <!-- Main Content Section -->
            <section class="h-full w-full">
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    {{-- Banner Section --}}
                    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                        <div class="bg-[url('{{ asset('images/adsbanner.png') }}')] lg:h-[225px] bg-cover bg-center rounded-2xl shadow-sm overflow-hidden relative p-6 lg:p-8">
                            <div class="absolute inset-0 bg-cover bg-center opacity-20" style="background-image: url('{{ asset('images/bg-pattern.png') }}');"></div>
                            <div class="relative z-10 flex flex-col items-center text-center">
                                <img src="{{ asset('images/logo.png') }}" class="w-[45px] h-[35px] mb-4" alt="logo">
                                <h2 class="text-[15px] font-bold text-[rgba(26,26,26,1)] mb-2">{{ __('common.our_story_title') }}</h2>
                                <p class="max-w-3xl text-[15px] mx-auto text-[rgba(102,102,102,1)] font-medium leading-relaxed mb-4">{{ __('common.our_story_desc', ['app' => config('app.name', 'عقار فيجن')]) }}</p>
                            </div>
                        </div>
                    </section>

                    {{-- Main Text Content --}}
                    <div class="p-6 md:p-10">
                        <div>
                            <h2 class="text-3xl md:text-[42px] font-bold text-[#303E7C] mb-8">{{ __('common.about_us') }}</h2>
                            <div class="font-medium text-sm text-gray-700 leading-8">
                                <div class="flex flex-col lg:flex-row gap-8 lg:gap-[80px]">
                                    <p>{!! nl2br(e(__('common.about_paragraph_1'))) !!}</p>
                                    <img src="{{ asset('images/whous.jpg') }}" class="rounded-2xl w-full lg:w-[338px] lg:h-[206px] object-cover shrink-0 mt-4 lg:mt-0" alt="About Us Image">
                                </div>
                                <p class="mt-8">{{ __('common.about_paragraph_2') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- CTA Banner Section --}}
                    <section class="mt-10 flex justify-center ">
                        <div class="w-full text-center p-6 md:p-8 lg:p-12 bg-cover bg-center" style="background-image: url('{{ asset('images/world.png') }}'); background-color: rgba(68, 112, 174, 1);">
                            <h2 class="text-white text-2xl md:text-[27.2px] font-medium mb-5">{{ __('common.get_ready_start_journey') }}</h2>
                            <p class="text-white/90 text-base md:text-[16.6px] mb-8 max-w-3xl mx-auto font-bold leading-relaxed">{{ __('common.we_are_here_to_help') }}</p>
                            <div class="flex flex-wrap justify-center gap-[14.2px]">
                                <a href="{{ route('properties.search') }}" class="inline-block bg-white text-[rgba(48,62,124,1)] text-[15px] font-medium py-2 px-5 rounded-full hover:bg-opacity-90 transition-colors">
                                   {{ __('common.search_for_property') }}
                                </a>
                                <a href="#" class="inline-block bg-[rgba(26,36,76,1)] text-[15px] text-white font-medium py-2 px-5 rounded-full hover:bg-opacity-90 transition-colors">
                                    {{ __('common.add_property_now') }}
                                </a>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
        </div>
    </section>
</main>

@endsection
