@extends('layouts.app') {{-- Use the main app layout --}}

@section('title', __('common.terms_of_use'))

@section('content')

<main class="py-10 bg-gray-50">
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4">
        <div class="flex flex-col w-full lg:flex-row gap-4">

            <!-- User Sidebar Navigation -->
            @include('partials.user_sidebar')

            <!-- Main Content Section -->
            <section class="h-full w-full">
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
                    <section class="py-9">
                        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-[53px]">
                            <div>
                                <div class="text-center mb-10">
                                    <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ __('common.terms_of_use') }}</h1>
                                    <p class="text-sm font-medium text-gray-500">{{ __('common.last_updated_at', ['date' => '19 يونيو 2025']) }}</p>
                                </div>

                                <p class="font-medium text-base leading-relaxed mb-12 max-w-4xl mx-auto text-center text-gray-700">
                                    {{ __('common.terms_intro', ['app' => config('app.name', 'عقار فيجن')]) }}
                                </p>

                                <div class="bg-gray-50 border border-gray-200 p-8 mb-16 rounded-lg">
                                    <h2 class="text-lg font-bold text-indigo-700 mb-6">{{ __('common.table_of_contents') }}</h2>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 text-gray-700 text-sm font-medium">
                                        <div class="space-y-3">
                                            <a href="#section-1" class="block hover:underline hover:text-indigo-600">{{ __('common.toc_accept_terms') }}</a>
                                            <a href="#section-2" class="block hover:underline hover:text-indigo-600">{{ __('common.toc_changes_to_terms') }}</a>
                                            <a href="#section-3" class="block hover:underline hover:text-indigo-600">{{ __('common.toc_accounts_registration') }}</a>
                                            <a href="#section-4" class="block hover:underline hover:text-indigo-600">{{ __('common.toc_platform_usage') }}</a>
                                            <a href="#section-5" class="block hover:underline hover:text-indigo-600">{{ __('common.toc_user_content') }}</a>
                                        </div>
                                        <div class="space-y-3">
                                            <a href="#section-6" class="block hover:underline hover:text-indigo-600">{{ __('common.toc_ip_rights') }}</a>
                                            <a href="#section-7" class="block hover:underline hover:text-indigo-600">{{ __('common.toc_privacy_policy') }}</a>
                                            <a href="#section-8" class="block hover:underline hover:text-indigo-600">{{ __('common.toc_payments_subscriptions') }}</a>
                                            <a href="#section-9" class="block hover:underline hover:text-indigo-600">{{ __('common.toc_disclaimer') }}</a>
                                            <a href="#section-10" class="block hover:underline hover:text-indigo-600">{{ __('common.toc_indemnification') }}</a>
                                        </div>
                                        <div class="space-y-3">
                                            <a href="#section-11" class="block hover:underline hover:text-indigo-600">{{ __('common.toc_account_termination') }}</a>
                                            <a href="#section-12" class="block hover:underline hover:text-indigo-600">{{ __('common.toc_governing_law') }}</a>
                                            <a href="#section-13" class="block hover:underline hover:text-indigo-600">{{ __('common.toc_general_provisions') }}</a>
                                            <a href="#section-14" class="block hover:underline hover:text-indigo-600">{{ __('common.toc_contact_us') }}</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-12">
                                    <div id="section-1">
                                        <h3 class="text-lg font-bold text-indigo-700 mb-4">{{ __('common.toc_accept_terms') }}</h3>
                                        <p class="text-base font-medium leading-loose text-gray-700">{{ __('common.sec1_accept_terms_text') }}</p>
                                    </div>
                                    <div id="section-2">
                                        <h3 class="text-lg font-bold text-indigo-700 mb-4">{{ __('common.toc_changes_to_terms') }}</h3>
                                        <p class="text-base font-medium leading-loose text-gray-700">{{ __('common.sec2_changes_to_terms_text') }}</p>
                                    </div>
                                    <div id="section-3">
                                        <h3 class="text-lg font-bold text-indigo-700 mb-4">{{ __('common.toc_accounts_registration') }}</h3>
                                        <p class="text-base font-medium leading-loose text-gray-700">{!! nl2br(e(__('common.sec3_accounts_registration_text'))) !!}</p>
                                    </div>
                                    <div id="section-4">
                                        <h3 class="text-lg font-bold text-indigo-700 mb-4">{{ __('common.toc_platform_usage') }}</h3>
                                        <p class="text-base font-medium leading-loose text-gray-700">{{ __('common.sec4_platform_usage_text') }}</p>
                                    </div>
                                    {{-- You can add the other sections here following the same pattern --}}
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
        </div>
    </section>
</main>

@endsection
