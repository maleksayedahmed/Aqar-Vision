@extends('layouts.agent')

@section('title', __('common.terms_of_use'))

@section('content')

    <main class="py-10 bg-[rgba(250,250,250,1)]">
        <section class="flex justify-center px-4 sm:px-6 lg:px-4">
            <div class="flex flex-col w-full lg:flex-row gap-4">

                <!-- Sidebar Navigation -->
                @include('partials.agent_sidebar')

                <!-- Main Content Section -->
                <section class="h-full w-full">
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
                        <section class="py-9">
                            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-[53px]">
                                <div>
                                    <div class="text-center mb-10">
                                        <h1 class="text-[22px] font-bold text-[rgba(26,26,26,1)] mb-2">
                                            {{ __('common.terms_of_use') }}</h1>
                                        <p class="text-[12px] font-medium text-[rgba(102,102,102,1)]">
                                            {{ __('common.last_updated_at', ['date' => '19 يونيو 2025']) }}</p>
                                    </div>

                                    <p
                                        class="font-medium text-[13.74px] leading-relaxed mb-12 max-w-4xl mx-auto text-center">
                                        {!! __('common.terms_intro', [
                                            'app' => '<span class="text-[rgba(48,62,124,1)] font-bold">' . config('app.name') . '</span>',
                                        ]) !!}
                                    </p>

                                    <div class="bg-[rgba(249,250,255,1)] p-8 mb-16 rounded-lg">
                                        <h2 class="text-[18px] font-bold text-[rgba(48,62,124,1)] mb-6">
                                            {{ __('common.table_of_contents') }}</h2>
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 text-gray-700 text-sm">
                                            <div class="space-y-3">
                                                <a href="#section-1"
                                                    class="block hover:underline">{{ __('common.toc_accept_terms') }}</a>
                                                <a href="#section-2"
                                                    class="block hover:underline">{{ __('common.toc_changes_to_terms') }}</a>
                                                <a href="#section-3"
                                                    class="block hover:underline">{{ __('common.toc_accounts_registration') }}</a>
                                                <a href="#section-4"
                                                    class="block hover:underline">{{ __('common.toc_platform_usage') }}</a>
                                                <a href="#section-5"
                                                    class="block hover:underline">{{ __('common.toc_user_content') }}</a>
                                            </div>
                                            <div class="space-y-3">
                                                <a href="#section-6"
                                                    class="block hover:underline">{{ __('common.toc_ip_rights') }}</a>
                                                <a href="#section-7"
                                                    class="block hover:underline">{{ __('common.toc_privacy_policy') }}</a>
                                                <a href="#section-8"
                                                    class="block hover:underline">{{ __('common.toc_payments_subscriptions') }}</a>
                                                <a href="#section-9"
                                                    class="block hover:underline">{{ __('common.toc_disclaimer') }}</a>
                                                <a href="#section-10"
                                                    class="block hover:underline">{{ __('common.toc_indemnification') }}</a>
                                            </div>
                                            <div class="space-y-3">
                                                <a href="#section-11"
                                                    class="block hover:underline">{{ __('common.toc_account_termination') }}</a>
                                                <a href="#section-12"
                                                    class="block hover:underline">{{ __('common.toc_governing_law') }}</a>
                                                <a href="#section-13"
                                                    class="block hover:underline">{{ __('common.toc_general_provisions') }}</a>
                                                <a href="#section-14"
                                                    class="block hover:underline">{{ __('common.toc_contact_us') }}</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-y-12">
                                        <div id="section-1">
                                            <h3 class="text-[18px] font-bold text-[rgba(48,62,124,1)] mb-4">
                                                {{ __('common.toc_accept_terms') }}</h3>
                                            <p class="text-[16px] font-medium leading-loose text-gray-700">
                                                {{ __('common.sec1_accept_terms_text') }}</p>
                                        </div>
                                        <div id="section-2">
                                            <h3 class="text-[18px] font-bold text-[rgba(48,62,124,1)] mb-4">
                                                {{ __('common.toc_changes_to_terms') }}</h3>
                                            <p class="text-[16px] font-medium leading-loose text-gray-700">
                                                {{ __('common.sec2_changes_to_terms_text') }}</p>
                                        </div>
                                        <div id="section-3">
                                            <h3 class="text-[18px] font-bold text-[rgba(48,62,124,1)] mb-4">
                                                {{ __('common.toc_accounts_registration') }}</h3>
                                            <p class="text-[16px] font-medium leading-loose text-gray-700">
                                                {{ __('common.sec3_accounts_registration_text') }}</p>
                                        </div>
                                        <div id="section-4">
                                            <h3 class="text-[18px] font-bold text-[rgba(48,62,124,1)] mb-4">
                                                {{ __('common.toc_platform_usage') }}</h3>
                                            <p class="text-[16px] font-medium leading-loose text-gray-700">
                                                {{ __('common.sec4_platform_usage_text') }}</p>
                                        </div>
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
