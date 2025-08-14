@extends('layouts.app')

@section('title', 'إعلاناتي')

@section('content')

<main class="py-10 bg-[rgba(250,250,250,1)]">
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4">
        <div class="flex flex-col lg:flex-row gap-4">

            <!-- User Sidebar Navigation -->
           @include('partials.user_sidebar')

            <div class="w-full">
                <!-- Promotion Section -->
                <section class="max-w-7xl mx-auto px-4 sm:px-0 md:px-4">
                    {{-- This section now has the exact same styling as the agent's page --}}
                    <div class="bg-[rgba(79,171,232,0.07)] border border-[rgba(79,171,232,1)] rounded-2xl p-6 shadow-sm">
                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                            <div class="w-full text-right">
                                <h3 class="text-[15px] font-bold text-[rgba(79,171,232,1)] mb-3">
                                    لديك عقار للبيع أو الإيجار؟ ابدأ إعلانك هنا!
                                </h3>
                                <p class="text-[15px] text-[rgba(102,102,102,1)] font-medium leading-relaxed">
                                    يمكنك الآن إصدار رخصة إعلان لعقارك والوصول إلى آلاف المشترين أو المستأجرين المحتملين بكل سهولة.
                                    <br>
                                    لديك حق 3 إعلان متاح كحد أقصى لحسابك العادي.
                                </p>
                            </div>
                            <a href="#" class="text-[11px] w-[125px] h-[32px] inline-flex items-center justify-center gap-x-2 whitespace-nowrap bg-[rgba(79,171,232,1)] text-white font-medium py-3 px-5 rounded-lg shadow-sm hover:bg-opacity-90 transition-colors flex-shrink-0">
                                <img src="{{ asset('images/plus.svg') }}">
                                <span>أضف إعلان</span>
                            </a>
                        </div>
                    </div>
                </section>

                <section class="bg-white rounded-xl shadow-sm p-4 sm:p-6 w-full mt-4">
                    <!-- Tab Navigation -->
                    <div class="border-b border-gray-200 mb-6">
                        <nav class="-mb-px flex gap-x-1 sm:gap-x-4 overflow-x-auto whitespace-nowrap pb-3 text-sm font-bold text-gray-600">
                            {{-- Active tab color is now identical to the agent's page --}}
                            <a href="{{ route('user.my-ads', ['tab' => 'active']) }}" class="py-2.5 px-5 rounded-full transition-colors {{ $currentTab == 'active' ? 'bg-[#3A487E] text-white shadow-sm' : 'hover:bg-gray-100' }}">
                                اعلانات مفعلة ({{ $activeCount }})
                            </a>
                            <a href="{{ route('user.my-ads', ['tab' => 'pending']) }}" class="py-2.5 px-5 rounded-full transition-colors {{ $currentTab == 'pending' ? 'bg-[#3A487E] text-white shadow-sm' : 'hover:bg-gray-100' }}">
                                اعلانات معلقة ({{ $pendingCount }})
                            </a>
                            <a href="{{ route('user.my-ads', ['tab' => 'deleted']) }}" class="py-2.5 px-5 rounded-full transition-colors {{ $currentTab == 'deleted' ? 'bg-[#3A487E] text-white shadow-sm' : 'hover:bg-gray-100' }}">
                                اعلانات محذوفة ({{ $deletedCount }})
                            </a>
                            <a href="{{ route('user.my-ads', ['tab' => 'expired']) }}" class="py-2.5 px-5 rounded-full transition-colors {{ $currentTab == 'expired' ? 'bg-[#3A487E] text-white shadow-sm' : 'hover:bg-gray-100' }}">
                                اعلانات منتهية ({{ $expiredCount }})
                            </a>
                        </nav>
                    </div>

                    <!-- Ads List -->
                    <div class="space-y-4">
                        @forelse ($ads as $ad)
                            {{-- The ad card layout is now identical to the agent's page --}}
                            <div class="bg-[rgba(249,250,252,1)] min-h-[162px] rounded-xl p-4 sm:p-5">
                                <div class="flex flex-col md:flex-row-reverse items-start h-[122px] md:items-center justify-between gap-y-4 gap-x-6">
                                    <div class="w-full h-full md:w-auto flex flex-row items-center md:flex-col md:items-end justify-between md:gap-y-4">
                                        <span class="bg-[rgba(221,162,80,0.18)] text-[rgba(221,162,80,1)] text-[10.4px] font-medium px-3 py-1 rounded-md self-start md:self-end">
                                            {{ optional($ad->adPrice)->name ?? 'عادي' }}
                                        </span>
                                        <a href="{{ route('properties.show', $ad->id) }}" class="w-[142px] inline-flex items-center text-[12px] gap-x-2 bg-[rgba(48,62,124,1)] justify-between text-white font-medium py-2 px-5 rounded-lg shadow-sm hover:bg-opacity-70 transition-colors">
                                            <span>رؤية التفاصيل</span>
                                            <img src="{{ asset('images/next-arrow.svg') }}">
                                        </a>
                                    </div>
                                    <div class="text-right flex flex-col h-full justify-between flex-grow">
                                        <div>
                                            <h3 class="font-semibold text-[rgba(26,26,26,1)] text-[14.5px]">{{ $ad->title }}</h3>
                                            <div class="flex items-center gap-x-1 text-[10.2px] font-semibold text-[rgba(26,26,26,1)] mt-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-[rgba(48,62,124,1)]" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                                </svg>
                                                <span>{{ $ad->district?->city?->name }} - {{ $ad->district?->name }}</span>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-x-1.5 text-xs text-gray-400 mt-4">
                                            <img src="{{ asset('images/clock.svg') }}" alt="">
                                            <span> {{ $ad->created_at->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-16">
                                <p class="text-gray-500 font-medium">لا توجد إعلانات في هذا القسم حالياً.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination Links -->
                    <div class="mt-8">
                        {{ $ads->appends(request()->query())->links() }}
                    </div>
                </section>
            </div>
        </div>
    </section>

    <!-- CTA Section to encourage upgrade -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4 py-4 mt-6">
        <div class="bg-[url('{{ asset('images/adsbanner.png') }}')] lg:h-[225px] bg-cover bg-center rounded-2xl shadow-sm overflow-hidden relative p-8 lg:p-4">
            <div class="absolute inset-0 bg-cover bg-center opacity-20" style="background-image: url('{{ asset('images/bg-pattern.png') }}');"></div>
            <div class="relative z-10 flex flex-col items-center text-center">
                <img src="{{ asset('images/logo.png') }}" class="w-[45px] h-[35px] mb-4" alt="logo">
                <h2 class="text-[15px] font-bold text-[rgba(26,26,26,1)] mb-2">
                    هل انت مسوق عقاري؟
                </h2>
                <p class="max-w-3xl text-[15px] mx-auto text-[rgba(102,102,102,1)] font-medium leading-relaxed mb-4">
                    إذا كنت وسيطًا عقاريًا أو لديك عدد كبير من العقارات، قم بترقية حسابك إلى حساب عقاري للاستفادة من باقات متعددة للإعلانات وميزات إدارة متقدمة.
                </p>
                <a href="#" class="bg-[#303F7C] text-white font-bold py-3 px-12 rounded-lg hover:bg-opacity-90 transition-colors shadow-md">
                    تحويل الحساب
                </a>
            </div>
        </div>
    </section>
</main>

@endsection