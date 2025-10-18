@extends('layouts.app')

@section('title', __('common.complaints'))

@section('content')

<main class="py-10 bg-[rgba(250,250,250,1)]">
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4">
        <div class="flex flex-col w-full lg:flex-row gap-4">

            <!-- User Sidebar Navigation -->
            @include('partials.user_sidebar')

            <!-- Feedback Section -->
            {{-- The padding and background of this section now match the agent's page --}}
            <section class="w-full py-16 rounded-xl bg-white shadow-sm">
                <div class="w-full px-4 sm:px-6 lg:px-8">

                    <!-- Section Header -->
                    <div class="text-center mb-12">
                        <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-800">{{ __('common.share_opinion_title') }}</h2>
                        <p class="mt-4 text-gray-600 leading-relaxed max-w-2xl mx-auto">
                            {{ __('common.share_opinion_paragraph') }}
                        </p>
                    </div>

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-100 text-green-800 border border-green-300 rounded-lg" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Form -->
                    <form method="POST" action="{{ route('user.complaints.store') }}" class="space-y-8 max-w-2xl mx-auto">
                        @csrf
                        <!-- Full Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('common.full_name') }}</label>
                            {{-- Input styling now matches the agent's page --}}
                            <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required placeholder="{{ __('common.enter_full_name') }}" class="w-full bg-white border border-gray-200 rounded-xl py-3 px-4 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#303F7C] focus:border-transparent placeholder:text-gray-400">
                            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __('common.email') }}</label>
                            {{-- Input styling now matches the agent's page --}}
                            <input type="email" id="email" name="email" dir="ltr" value="{{ old('email', auth()->user()->email) }}" required placeholder="example@domain.com" class="text-left w-full bg-white border border-gray-200 rounded-xl py-3 px-4 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#303F7C] focus:border-transparent placeholder:text-gray-400">
                            @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Note Type Field -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">{{ __('common.comment_type') }}</label>
                            <div class="relative">
                                {{-- Select styling now matches the agent's page --}}
                                <select id="type" name="type" required class="w-full appearance-none bg-white border border-gray-200 text-gray-800 rounded-xl py-3 px-4 pl-10 focus:outline-none focus:ring-2 focus:ring-[#303F7C] focus:border-transparent">
                                    <option value="" disabled selected>{{ __('common.choose_comment_type') }}</option>
                                    <option value="complaint" @if(old('type') == 'complaint') selected @endif>{{ __('common.complaint') }}</option>
                                    <option value="suggestion" @if(old('type') == 'suggestion') selected @endif>{{ __('common.suggestion') }}</option>
                                    <option value="feedback" @if(old('type') == 'feedback') selected @endif>{{ __('common.general_feedback') }}</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center px-4 text-gray-500">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                            @error('type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Details Field -->
                        <div>
                            <label for="details" class="block text-sm font-medium text-gray-700 mb-2">{{ __('common.details') }}</label>
                            {{-- Textarea styling now matches the agent's page --}}
                            <textarea id="details" name="details" rows="6" required placeholder="{{ __('common.describe_complaint_placeholder') }}" class="w-full bg-white border border-gray-200 rounded-xl py-3 px-4 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#303F7C] focus:border-transparent placeholder:text-gray-400">{{ old('details') }}</textarea>
                            @error('details')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4 text-center">
                            {{-- Button color now matches the agent's page --}}
                            <button type="submit" class="bg-[#303F7C] hover:bg-opacity-90 text-white font-semibold text-lg py-3 px-20 rounded-xl transition-colors">{{ __('common.send') }}</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </section>
</main>

@endsection
