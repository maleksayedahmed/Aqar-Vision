{{-- resources/views/agent/package.blade.php --}}

@extends('layouts.agent')

@section('title', __('common.agent_packages'))

@section('content')

    <main class="flex lg:px-20 px-4  flex-col items-center lg:min-h-screen pt-[60px] pb-8 lg:pb-[140px]">

        <!-- Responsive Pricing Section -->
        <section class="pb-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="text-center">
                    <!-- Heading -->
                    <h2 class="text-2xl md:text-[32px] font-medium text-[rgba(48,62,124,1)] mb-4">
                        {{ __('common.choose_package') }}</h2>
                    <!-- Description -->
                    <p class="max-w-3xl mx-auto text-[rgba(77,77,77,1)] leading-relaxed">{{ __('common.packages_desc') }}</p>

                    <!-- Billing Cycle Toggle Switch -->
                    <div class="mt-8 flex justify-center">
                        <div class="inline-flex bg-gray-100 p-1.5 rounded-full">
                            <button id="yearly-btn"
                                class="px-6 sm:px-10 py-2.5 text-base md:text-[17.28px] font-bold text-white bg-[rgba(48,62,124,1)] rounded-full shadow-sm transition-colors duration-300 ease-in-out focus:outline-none">{{ __('common.yearly') }}</button>
                            <button id="monthly-btn"
                                class="px-6 sm:px-10 py-2.5 text-base md:text-[17.28px] font-medium text-[rgba(26,26,26,1)] rounded-full transition-colors duration-300 ease-in-out focus:outline-none">{{ __('common.monthly') }}</button>
                        </div>
                    </div>
                </div>

                <!-- Pricing Cards Grid -->
                <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                    <!-- Card 1: Basic -->
                    <div class="price-card bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8 flex flex-col">
                        <div class="text-center">
                            <h3 class="text-xl md:text-[23.3px] font-medium text-[rgba(3,33,110,1)]">
                                {{ __('common.basic_package') }}</h3>
                            <p
                                class="text-3xl md:text-[31.3px] my-4 font-medium text-[rgba(26,26,26,1)] flex justify-center items-end gap-[9.3px]">
                                <span class="price-value" data-monthly="150" data-yearly="1500">1500</span>
                                <span
                                    class="billing-cycle text-base md:text-[16.6px] text-[rgba(26,26,26,1)] flex items-center"><img
                                        src="images/royal.png" class="inline h-4 mr-1"
                                        alt="Currency">{{ __('common.per_year') }}</span>
                            </p>
                            <p class="text-[rgba(153,153,153,1)] text-[15.5px] min-h-[3rem]">
                                {{ __('common.ideal_for_few_properties') }}</p>
                        </div>
                        <ul class="mt-8 space-y-4 text-sm font-medium text-gray-700 flex-grow">
                            <!-- features list -->
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg><span>{{ __('common.show_n_properties', ['count' => 5]) }}</span></li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg><span>{{ __('common.technical_support') }}</span></li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg><span>{{ __('common.high_quality_media') }}</span></li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg><span>{{ __('common.ad_view_stats') }}</span></li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg><span>{{ __('common.campaign_management') }}</span></li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg><span>{{ __('common.performance_analysis') }}</span></li>
                        </ul>
                        <a href="#"
                            class="w-full mt-8 bg-[rgba(48,62,124,1)] text-white text-lg md:text-[21.3px] font-medium py-3 text-center rounded-lg hover:bg-opacity-90 transition-colors">{{ __('common.subscribe_now') }}</a>
                    </div>

                    <!-- Card 2: Most Popular -->
                    <div
                        class="price-card bg-white rounded-xl shadow-lg border-2 border-[rgba(27,177,105,1)] p-6 md:p-8 flex flex-col relative">
                        <span
                            class="absolute -top-4 right-1/2 transform translate-x-1/2 bg-[rgba(27,177,105,1)] text-white text-xs font-bold px-4 py-1.5 rounded-full">{{ __('common.most_popular') }}</span>
                        <div class="text-center">
                            <h3 class="text-xl md:text-[23.3px] font-medium text-[rgba(27,177,105,1)]">
                                {{ __('common.basic_package') }}</h3>
                            <p
                                class="text-3xl md:text-[31.3px] my-4 font-medium text-[rgba(26,26,26,1)] flex justify-center items-end gap-[9.3px]">
                                <span class="price-value" data-monthly="300" data-yearly="3000">3000</span>
                                <span
                                    class="billing-cycle text-base md:text-[16.6px] text-[rgba(26,26,26,1)] flex items-center">{{ __('common.per_year') }}</span>
                            </p>
                            <p class="text-[rgba(153,153,153,1)] text-[15.5px] min-h-[3rem]">
                                {{ __('common.ideal_for_few_properties') }}</p>
                        </div>
                        <ul class="mt-8 space-y-4 text-sm font-medium text-gray-700 flex-grow">
                            <!-- features list -->
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg><span>{{ __('common.show_n_properties', ['count' => 20]) }}</span></li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg><span>{{ __('common.priority_support') }}</span></li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg><span>{{ __('common.high_quality_media') }}</span></li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg><span>{{ __('common.ad_view_stats') }}</span></li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg><span>{{ __('common.campaign_management') }}</span></li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg><span>{{ __('common.performance_analysis') }}</span></li>
                        </ul>
                        <a href="#"
                            class="w-full mt-8 bg-[rgba(27,177,105,1)] text-white text-lg md:text-[21.3px] font-medium py-3 text-center rounded-lg hover:bg-opacity-90 transition-colors">{{ __('common.subscribe_now') }}</a>
                    </div>

                    <!-- Card 3: Companies -->
                    <div class="price-card bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8 flex flex-col">
                        <div class="text-center">
                            <h3 class="text-xl md:text-[23.3px] font-medium text-[rgba(3,33,110,1)]">
                                {{ __('common.companies_package') }}</h3>
                            <p
                                class="text-3xl md:text-[31.3px] my-4 font-medium text-[rgba(26,26,26,1)] flex justify-center items-end gap-[9.3px]">
                                <span class="price-value" data-monthly="500" data-yearly="5000">5000</span>
                                <span
                                    class="billing-cycle text-base md:text-[16.6px] text-[rgba(26,26,26,1)] flex items-center">{{ __('common.per_year') }}</span>
                            </p>
                            <p class="text-[rgba(153,153,153,1)] text-[15.5px] min-h-[3rem]">
                                {{ __('common.ideal_for_few_properties') }}</p>
                        </div>
                        <ul class="mt-8 space-y-4 text-sm font-medium text-gray-700 flex-grow">
                            <!-- features list -->
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg><span>{{ __('common.show_n_properties', ['count' => 50]) }}</span></li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg><span>{{ __('common.support_24_7') }}</span></li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg><span>{{ __('common.promote_featured_ads', ['count' => 5]) }}</span></li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg><span>{{ __('common.access_all_statistics') }}</span></li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg><span>{{ __('common.multi_user_admin_account') }}</span></li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg><span>تحليل الأداء شهريًا لضمان أفضل النتائج</span></li>
                        </ul>
                        <a href="#"
                            class="w-full mt-8 bg-[rgba(48,62,124,1)] text-white text-lg md:text-[21.3px] font-medium py-3 text-center rounded-lg hover:bg-opacity-90 transition-colors">{{ __('common.subscribe_now') }}</a>
                    </div>

                </div>
            </div>
        </section>


        <!-- CTA Section -->
        <section class="w-full px-4 sm:px-6 lg:px-4 py-10">
            <div class=" ">
                <div
                    class="bg-[url('{{ asset('images/adsbanner.png') }}')] lg:h-[294px] bg-cover bg-center rounded-2xl shadow-sm overflow-hidden relative p-8 lg:p-10">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 bg-cover bg-center opacity-20"
                        style="background-image: url('{{ asset('images/bg-pattern.png') }}');"></div>

                    <!-- Content -->
                    <div class="relative z-10 flex flex-col items-center text-center">
                        <!-- Logo -->
                        <img src="{{ asset('images/logo.png') }}" class="w-[45px] h-[35px] mb-4" alt="logo">

                        <!-- Heading -->
                        <h2 class="text-[19px] font-bold text-[rgba(26,26,26,1)] mb-2">
                            {{ __('common.custom_packages_title') }}</h2>

                        <!-- Description -->
                        <p
                            class="max-w-3xl text-[19px] mx-auto text-[rgba(102,102,102,1)] font-medium leading-relaxed mb-4">
                            {{ __('common.custom_packages_desc') }}</p>

                        <!-- Action Button -->
                        <a href="#"
                            class="bg-[rgba(48,62,124,1)] text-white font-bold py-3 px-12 rounded-lg hover:bg-opacity-90 transition-colors shadow-md">
                            {{ __('common.contact_us_button') }}
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- packages toggle -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const monthlyBtn = document.getElementById('monthly-btn');
                const yearlyBtn = document.getElementById('yearly-btn');
                const priceCards = document.querySelectorAll('.price-card');

                function updatePrices(billingType) {
                    priceCards.forEach(card => {
                        const priceValueEl = card.querySelector('.price-value');
                        const billingCycleEl = card.querySelector('.billing-cycle');

                        const monthlyPrice = priceValueEl.getAttribute('data-monthly');
                        const yearlyPrice = priceValueEl.getAttribute('data-yearly');

                        if (billingType === 'yearly') {
                            priceValueEl.textContent = yearlyPrice;
                            billingCycleEl.innerHTML =
                                '<img src="{{ asset('images/royal.png') }}" class="h-[29px]" width="26.5">{{ __('common.per_year') }}';
                        } else {
                            priceValueEl.textContent = monthlyPrice;
                            billingCycleEl.innerHTML =
                                '<img src="{{ asset('images/royal.png') }}" class="h-[29px]" width="26.5">{{ __('common.per_month') }}';
                        }
                    });

                    // Update button styles
                    if (billingType === 'yearly') {
                        yearlyBtn.classList.add('bg-[rgba(48,62,124,1)]', 'text-white', 'shadow-sm');
                        yearlyBtn.classList.remove('text-[rgba(26,26,26,1)]');
                        monthlyBtn.classList.remove('bg-[rgba(48,62,124,1)]', 'text-white', 'shadow-sm');
                        monthlyBtn.classList.add('text-[rgba(26,26,26,1)]');
                    } else {
                        monthlyBtn.classList.add('bg-[rgba(48,62,124,1)]', 'text-white', 'shadow-sm');
                        monthlyBtn.classList.remove('text-[rgba(26,26,26,1)]');
                        yearlyBtn.classList.remove('bg-[rgba(48,62,124,1)]', 'text-white', 'shadow-sm');
                        yearlyBtn.classList.add('text-[rgba(26,26,26,1)]');
                    }
                }

                monthlyBtn.addEventListener('click', () => updatePrices('monthly'));
                yearlyBtn.addEventListener('click', () => updatePrices('yearly'));

                // Set initial state from the active button
                const initialBillingType = yearlyBtn.classList.contains('bg-[rgba(48,62,124,1)]') ? 'yearly' :
                    'monthly';
                updatePrices(initialBillingType);
            });
        </script>
    </main>

@endsection
