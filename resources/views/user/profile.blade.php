@extends('layouts.app')

@section('title', __('common.my_account'))

@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Listen for upgrade modal form changes to show/hide FAL license field
            const upgradeForm = document.getElementById('upgrade-request-form');
            const falLicenseContainer = document.querySelector('[data-fal-license-container]');

            if (upgradeForm && falLicenseContainer) {
                upgradeForm.addEventListener('change', function(e) {
                    if (e.target.name === 'requested_role') {
                        if (e.target.value === 'agent') {
                            falLicenseContainer.style.display = 'block';
                        } else {
                            falLicenseContainer.style.display = 'none';
                        }
                    }
                });
            }

            // Password confirmation validation
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('password_confirmation');

            if (passwordField && confirmPasswordField) {
                function validatePasswordMatch() {
                    if (passwordField.value && confirmPasswordField.value) {
                        if (passwordField.value !== confirmPasswordField.value) {
                            confirmPasswordField.setCustomValidity('{{ __('common.passwords_not_match') }}');
                        } else {
                            confirmPasswordField.setCustomValidity('');
                        }
                    }
                }

                passwordField.addEventListener('input', validatePasswordMatch);
                confirmPasswordField.addEventListener('input', validatePasswordMatch);
            }
        });
    </script>
@endpush

@section('content')

<main class="py-10 bg-[rgba(250,250,250,1)]">
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4">
    <div class="flex flex-col lg:flex-row gap-4">

        <!-- User Sidebar Navigation -->
        @include('partials.user_sidebar')

        <!-- Main Content Form -->
        <main class="w-full bg-white p-6 sm:p-8 sm:pr-11 rounded-xl shadow-sm relative">

            {{-- Success Message --}}
            @if (session('status') === 'profile-updated')
                <div class="mb-6 p-4 bg-green-100 text-green-800 border border-green-300 rounded-lg" role="alert">
                    <p>{{ __('common.changes_saved_successfully') }}</p>
                </div>
            @endif

            <form method="post" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div x-data="{photoName: null, photoPreview: null}">
                    <!-- Profile Header -->
                    <div class="mb-10 flex flex-col gap-y-6 sm:flex-row sm:justify-between items-start">
                        <div class="relative flex items-center gap-x-4 sm:gap-x-[45px]">

                            <!-- Profile Picture -->
                            <div class="w-24 h-24 sm:w-28 sm:h-28">
                                <img x-show="!photoPreview" src="{{ $user->profile_photo_path ? Storage::url($user->profile_photo_path) : asset('images/profile.png') }}" alt="{{ __('common.profile_image_alt') }}" class="w-full h-full rounded-full object-cover border-4 border-black shadow-md">
                                <span x-show="photoPreview" class="block w-full h-full rounded-full bg-cover bg-no-repeat bg-center border-4 border-black shadow-md"
                                      x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                </span>
                            </div>

                            <!-- Camera Button -->
                            <div class="absolute top-[70px] sm:top-[80px]">
                                <label for="profile_photo" class="bg-[#303E7C] text-white w-[42px] h-[30px] flex items-center justify-center rounded-full hover:bg-opacity-90 transition-colors cursor-pointer" aria-label="{{ __('common.change_image_aria_label') }}">
                                    <img src="{{ asset('images/camera-profile.svg') }}">
                                </label>
                                <input type="file" name="profile_photo" id="profile_photo" class="hidden"
                                       x-ref="photo"
                                       x-on:change="
                                           photoName = $refs.photo.files[0].name;
                                           const reader = new FileReader();
                                           reader.onload = (e) => { photoPreview = e.target.result; };
                                           reader.readAsDataURL($refs.photo.files[0]);
                                       ">
                            </div>

                            <div class="flex flex-col gap-[15px]">
                                <p class="bg-[rgba(27,177,105,0.09)] text-[rgba(27,177,105,1)] text-[14px] font-medium inline-block px-4 py-1.5 rounded-full mb-2 self-start">{{ __('common.general_account') }}</p>
                                <h1 class="text-xl sm:text-[26px] font-medium text-black">{{ $user->name }}</h1>
                            </div>
                        </div>
                    </div>

                    <!-- Form Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 px-2 sm:px-9 gap-x-6 gap-y-6">

                        <div>
                            <label for="name" class="block text-[11px] font-medium mb-2">{{ __('common.name') }}</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name"
                                   class="w-full h-[50px] text-[11px] font-medium border border-gray-200 text-gray-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#303F7C] focus:border-transparent">
                            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-[11px] font-medium mb-2">{{ __('common.enter_phone') }}</label>
                            <div class="relative">
                                <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}" required
                                       class="w-full pl-[100px] h-[50px] text-[11px] font-medium border border-gray-200 text-gray-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#303F7C] focus:border-transparent">
                                <div class="absolute inset-y-0 left-0 flex items-center px-3 pointer-events-none gap-2">
                                    <div class="h-6 border-l border-gray-300"></div>
                                    <img src="{{ asset('images/saudi_flag.png') }}" alt="Saudi Arabia Flag" class="w-6 h-4 object-cover">
                                    <span class="text-gray-600 font-medium">+966</span>
                                </div>
                            </div>
                            @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="email" class="block text-[11px] font-medium mb-2">{{ __('common.email') }}</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                                   class="w-full h-[50px] text-[11px] font-medium border border-gray-200 text-gray-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#303F7C] focus:border-transparent">
                            @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="password" class="block text-[11px] font-medium mb-2">{{ __('common.new_password_optional') }}</label>
                            <input type="password" id="password" name="password"
                                   class="w-full h-[50px] text-[11px] font-medium border border-gray-200 text-gray-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#303F7C] focus:border-transparent">
                            @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-[11px] font-medium mb-2">{{ __('common.confirm_password') }}</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="w-full h-[50px] text-[11px] font-medium border border-gray-200 text-gray-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#303F7C] focus:border-transparent">
                            @error('password_confirmation')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        @php
                            $latestRequest = $user->latestUpgradeRequest;
                            $showFalLicense = $user->agent && ($latestRequest && $latestRequest->requested_role === 'agent');
                        @endphp

                        @if($showFalLicense)
                            <div class="md:col-span-2" data-fal-license-container>
                                <label for="fal_license" class="block text-[11px] font-medium mb-2">{{ __('common.fal_license') }}</label>
                                <input type="text" id="fal_license" name="fal_license" value="{{ old('fal_license', optional($latestRequest && $latestRequest->license)->license_number ?? optional($user->agent->licenses->where('license_type_id', 1)->first())->license_number) }}"
                                       class="w-full md:w-[405px] h-[50px] text-[11px] font-medium border border-gray-200 text-gray-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#303F7C] focus:border-transparent">
                                @error('fal_license')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div data-fal-license-container>
                                <label for="license_issue_date" class="block text-[11px] font-medium mb-2">{{ __('common.license_issue_date') }}</label>
                                <input type="date" id="license_issue_date" name="license_issue_date" value="{{ old('license_issue_date', optional($latestRequest && $latestRequest->license)->issue_date?->format('Y-m-d') ?? optional($user->agent->licenses->where('license_type_id', 1)->first())->issue_date?->format('Y-m-d')) }}"
                                       class="w-full h-[50px] text-[11px] font-medium border border-gray-200 text-gray-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#303F7C] focus:border-transparent">
                                @error('license_issue_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div data-fal-license-container>
                                <label for="license_expiry_date" class="block text-[11px] font-medium mb-2">{{ __('common.license_expiry_date') }}</label>
                                <input type="date" id="license_expiry_date" name="license_expiry_date" value="{{ old('license_expiry_date', optional($latestRequest && $latestRequest->license)->expiry_date?->format('Y-m-d') ?? optional($user->agent->licenses->where('license_type_id', 1)->first())->expiry_date?->format('Y-m-d')) }}"
                                       class="w-full h-[50px] text-[11px] font-medium border border-gray-200 text-gray-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#303F7C] focus:border-transparent">
                                @error('license_expiry_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        @endif

                    </div>

                    <div class="mt-10 text-center">
                        <button type="submit" class="bg-[#303E7C] text-[19px] text-white font-medium py-3 px-16 rounded-lg hover:bg-opacity-90 transition-colors shadow-sm">
                            {{ __('common.save_changes') }}
                        </button>
                    </div>
                </div>
            </form>
        </main>
    </div>
</section>

<!-- CTA Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4 py-4 mt-4">
    @php
        $latestRequest = $user->latestUpgradeRequest;
        $isAgent = $user->agent !== null;
        $isAgency = $user->agency !== null;

        $showCTA = !$isAgent && !$isAgency && (
            !$latestRequest ||
            $latestRequest->status === 'rejected' ||
            ($latestRequest->status === 'approved' && (
                ($latestRequest->requested_role === 'agent' && !$user->agent) ||
                ($latestRequest->requested_role === 'agency' && !$user->agency)
            ))
        );

        $hasPendingRequest = $latestRequest && $latestRequest->status === 'pending';
        $hasApprovedRequest = $latestRequest && $latestRequest->status === 'approved';
        $hasRejectedRequest = $latestRequest && $latestRequest->status === 'rejected';
    @endphp

    @if($showCTA)
        <div class="bg-[url('{{ asset('images/adsbanner.png') }}')] lg:h-[225px] bg-cover bg-center rounded-2xl shadow-sm overflow-hidden relative p-8 lg:p-4">
            <div class="absolute inset-0 bg-cover bg-center opacity-20" style="background-image: url('{{ asset('images/bg-pattern.png') }}');"></div>
            <div class="relative z-10 flex flex-col items-center text-center">
                <img src="{{ asset('images/logo.png') }}" class="w-[45px] h-[35px] mb-4" alt="logo">
                <h2 class="text-[15px] font-bold text-[rgba(26,26,26,1)] mb-2">{{ __('common.are_you_an_agent') }}</h2>
                <p class="max-w-3xl text-[15px] mx-auto text-[rgba(102,102,102,1)] font-medium leading-relaxed mb-4">
                    {{ __('common.join_platform_message') }}
                </p>
                <button type="button" id="open-upgrade-modal" class="bg-[#303F7C] text-white font-bold py-3 px-12 rounded-lg hover:bg-opacity-90 transition-colors shadow-md">
                    {{ __('common.join_as_agent') }}
                </button>
            </div>
        </div>
    @endif

    @if($isAgency)
        <div class="mt-6">
            <a href="{{ route('agency.dashboard') }}" class="inline-block bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700">{{ __('common.go_to_agency_dashboard') }}</a>
        </div>
    @endif

    @if($hasPendingRequest)
        <div class="bg-blue-50 border-l-4 border-blue-400 p-6 rounded-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="mr-3">
                    <h3 class="text-lg font-medium text-blue-800">{{ __('common.account_upgrade_request_pending') }}</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <p>{{ __('common.upgrade_request_sent_to', ['role' => $latestRequest->requested_role === 'agent' ? __('common.agent_title') : __('common.real_estate_company'), 'date' => $latestRequest->created_at->format('d/m/Y')]) }}</p>
                        <p class="mt-1">{{ __('common.under_review_will_notify') }}</p>
                    </div>
                    <div class="mt-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ __('common.account_upgrade_request_pending') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($hasRejectedRequest)
        <div class="bg-red-50 border-l-4 border-red-400 p-6 rounded-lg">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
                <div class="mr-3">
                    <h3 class="text-lg font-medium text-red-800">{{ __('common.upgrade_request_rejected') }}</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <p>{{ __('common.upgrade_request_sent_to', ['role' => $latestRequest->requested_role === 'agent' ? __('common.agent_title') : __('common.real_estate_company'), 'date' => $latestRequest->processed_at ? $latestRequest->processed_at->format('d/m/Y') : __('common.not_specified')]) }}</p>
                        @if($latestRequest->admin_notes)
                            <div class="mt-3 p-3 bg-red-100 rounded-lg">
                                <p class="font-medium text-red-800">{{ __('common.rejection_reason') }}</p>
                                <p class="mt-1">{{ $latestRequest->admin_notes }}</p>
                            </div>
                        @endif
                        <p class="mt-3">{{ __('common.can_resend_request_after_improve') }}</p>
                    </div>
                    <div class="mt-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            {{ __('common.upgrade_request_rejected') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endif
</section>
</main>

@endsection
