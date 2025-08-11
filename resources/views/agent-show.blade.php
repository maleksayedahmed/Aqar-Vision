@extends('layouts.app')

@section('title', 'ملف المسوق: ' . $agent->name)

@section('content')
<main class="flex flex-col items-center justify-center min-h-screen pt-[35px]">
    <!-- Agent Profile Section -->
    <section class="bg-[rgba(248,248,248,1)] p-6 md:pr-[60px] md:pl-[30px] rounded-2xl w-[94%] font-madani">
        <div class="flex flex-col gap-[23px]">
            <!-- Top Info Section -->
            <div class="flex flex-col-reverse sm:flex-row-reverse gap-5 items-start">

                <!-- Left Side: Info -->
                <div class="flex-1 flex flex-col items-start gap-2">
                    <!-- Badge -->
                     <div class="flex items-center justify-between w-full">
                        
                        <div class="flex items-center font-medium gap-0.5 text-[rgba(48,62,124,1)] text-[14px]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-[rgba(217,222,242,1)]" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 20l-4.95-6.05a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $agent->agent?->city?->name ?? 'غير محدد' }}</span>
                            </div>
                            <span class="bg-[rgba(223,246,226,1)] text-[rgba(117,177,123,1)] text-[17.5px] font-normal px-2.5 pt-1 pb-1.5 rounded-full">مسوق عقاري</span>

                     </div>
                    
                    <!-- Name -->
                    <h2 class="text-[28px] lg:text-4xl font-semibold text-[rgba(48,62,124,1)] h-[50px]">{{ $agent->name }}</h2>

                    <!-- Stats Row -->
                    <div class="flex flex-wrap items-center gap-3 text-[rgba(48,62,124,1)] text-sm font-normal">
                        <!-- Stat: Properties -->
                        <span class="flex items-center gap-2 bg-[rgba(48,62,124,0.02)] rounded-lg px-3 py-3">
                             <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Shortened SVG Paths -->
                                <path d="M3.06...Z" fill="#303E7C"/>
                                <path d="M0 14...Z" fill="#303E7C"/>
                                <path d="M4.09...Z" fill="#303E7C"/>
                                <path d="M9.22...Z" fill="#303E7C"/>
                             </svg>
                            <span>+{{ $ads->total() }} عقار</span>
                        </span>
                        <!-- Stat: Location -->
                        <span class="flex items-center gap-2 bg-[rgba(48,62,124,0.02)] rounded-lg px-3 py-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                               <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 20l-4.95-6.05a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <span>{{ $agent->agent?->city?->name ?? 'غير محدد' }}</span>
                        </span>
                        <!-- Stat: Experience -->
                        <span class="flex items-center gap-2 bg-[rgba(48,62,124,0.02)] rounded-lg px-3 py-3">
                            <img src="{{ asset('images/star.svg') }}">
                            <span>خبرة 4-5 سنوات</span> <!-- Note: This is static -->
                        </span>
                    </div>

                </div>

                <!-- Right Side: Avatar -->
                <div class="flex-shrink-0 self-center sm:self-start">
                    @if ($agent->profile_photo_path)
                        {{-- If the agent has a profile picture, display it --}}
                        <img src="{{ Storage::url($agent->profile_photo_path) }}" alt="{{ $agent->name }}" class="w-32 h-32 md:w-40 md:h-40 rounded-full object-cover shadow-md">
                    @else
                        {{-- Otherwise, display the initials in a styled circle --}}
                        <div class="flex items-center justify-center w-32 h-32 md:w-40 md:h-40 bg-indigo-100 rounded-full shadow-md">
                            <span class="font-bold text-5xl text-indigo-500">
                                {{ strtoupper(substr($agent->name, 0, 2)) }}
                            </span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- divider and buttons -->
            <div class="flex justify-between flex-col sm:flex-row gap-5 sm:gap-0">
                <!-- Divider and Description -->
                <div class="">
                    <h3 class="text-lg font-medium mb-3">نبذة تعريفية</h3>
                    <p class="text-slate-600 leading-relaxed text-[16px]">
                        {{ $agent->agent?->bio ?? 'هذا النص هو مثال بسيط يستخدم كقالب نصي في التصاميم او المستندات يمكن تعديله حسب الحاجة ليعكس شكل المحتوى الحقيقي المتوقع في المشروع.' }}
                    </p>
                </div>
                <!-- Buttons Row -->
                <div class="flex flex-wrap sm:flex-nowrap sm:items-end gap-2 w-full max-w-[390px] font-sans">
                    <!-- Call Button -->
                    <a href="tel:{{ $agent->phone }}" class="w-full sm:w-auto py-2.5 px-9 flex items-center justify-center gap-2 rounded-2xl bg-[rgba(48,63,125,1)] text-white hover:bg-indigo-800 transition-colors text-[20px] font-medium">
                        <img src="{{ asset('images/phone.svg') }}">
                        <span>اتصال</span>
                    </a>
                    
                    <!-- Message Button -->
                    <a href="mailto:{{ $agent->email }}" class="w-full sm:w-auto py-2 px-8 flex items-center justify-center gap-2 rounded-2xl border-[1px] border-[rgba(48,63,125,1)] text-[rgba(48,63,125,1)] hover:bg-indigo-100/50 transition-colors text-[20px] font-medium">
                        <img src="{{ asset('images/message.svg') }}" alt="Message Icon">
                        <span>راسلني</span>
                    </a>
                    
                    <!-- WhatsApp Button -->
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $agent->phone) }}" target="_blank" title="WhatsApp" class="w-full sm:w-[66px] h-[50px] flex items-center justify-center rounded-2xl border-[1px] border-[rgba(27,177,105,1)] text-[#25D366] hover:bg-green-100/50 transition-colors">
                        <img src="{{ asset('images/wa.svg') }}">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full bg-white">
        <div class="mt-8 px-[3%]">
            <div class="flex items-end justify-between">
                <div class="flex gap-[33px] flex-col">
                     <p class="text-[22px] font-medium">إعلانات عقارية فعّالة</p>
                     <div class="flex items-center gap-3">
                        <span class="text-xl font-light">عرض {{ $ads->count() }} من {{ $ads->total() }} عقار مرتبة حسب</span>
                        <!-- Alpine.js Dropdown Component -->
<div x-data="{ isOpen: false }" class="relative">
    <!-- The Button that shows the current sort option -->
    <button @click="isOpen = !isOpen" class="inline-flex items-center justify-between min-w-[180px] gap-1 rounded-xl border border-black bg-white px-3 py-1 text-sm font-light text-gray-800 shadow-sm hover:bg-gray-50">
        <div class="flex items-center gap-1">
            <img src="{{ asset('images/sittings.svg') }}">
            <span>{{ $sortText }}</span> <!-- This text comes from the controller -->
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 transition-transform" :class="{'rotate-180': isOpen}">
            <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 011.06 0L10 11.94l3.72-3.72a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.22 9.28a.75.75 0 010-1.06z" clip-rule="evenodd"></path>
        </svg>
    </button>

    <!-- The Dropdown Menu with the links -->
    <div 
        x-show="isOpen"
        @click.away="isOpen = false"
        x-transition
        class="absolute z-10 mt-2 w-full origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
        style="display: none;"
    >
        @php
            $sortOptions = [
                'latest' => 'الأحدث',
                'oldest' => 'الأقدم',
                'price_desc' => 'السعر: من الأعلى للأقل',
                'price_asc' => 'السعر: من الأقل للأعلى',
            ];
        @endphp
        <div class="py-1">
            @foreach($sortOptions as $key => $value)
                <a 
                    href="{{ route('agents.show', ['agent' => $agent->id, 'sort' => $key]) }}" 
                    class="block px-4 py-2 text-sm text-right font-medium"
                    {{-- This class dynamically highlights the active sort option --}}
                    :class="{ 'bg-indigo-50 text-indigo-700': '{{ $sortBy }}' === '{{ $key }}', 'text-gray-700 hover:bg-gray-100': '{{ $sortBy }}' !== '{{ $key }}' }"
                >
                    {{ $value }}
                </a>
            @endforeach
        </div>
    </div>
</div>
                     </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 px-4 gap-6 mt-8 place-items-center">
            @forelse ($ads as $ad)
                <!-- card -->
                <div class="bg-white border border-gray-100 rounded-xl w-[320px] flex-shrink-0 snap-start shadow-sm hover:shadow-lg transition-shadow duration-300">
                    <div>
                        <!-- Image Section -->
                        <div class="relative">
                            <img src="{{ !empty($ad->images) ? Storage::url($ad->images[0]) : 'https://placehold.co/400x300' }}" class="w-full h-48 object-cover rounded-lg" alt="{{ $ad->title }}">
                            <div class="absolute top-0 left-4 bg-white text-[rgba(48,62,124,1)] text-sm font-medium px-3.5 py-1.5 rounded-b">{{ $ad->listing_purpose == 'rent' ? 'إيجار' : 'بيع' }}</div>
                            <button class="absolute top-2.5 right-3 bg-[rgba(255,255,255,0.27)] p-1.5 rounded-lg hover:shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[rgba(242,242,242,1)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>
                            </button>
                        </div>
                        <!-- Details Section -->
                        <div class="p-3 space-y-[23px]">
                            <div class="flex justify-between items-center text-xs text-[rgba(204,204,204,1)]">
                                <span class="flex items-center gap-0.5 font-semibold text-black">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[rgba(48,62,124,1)]" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 20l-4.95-6.05a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                                    {{ $ad->district?->city?->name }} - {{ $ad->district?->name }}
                                </span>
                                <span class="flex items-center gap-0.5">
                                    <img src="{{ asset('images/clock.svg') }}">
                                    {{ $ad->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                            <div class="space-y-1.5">
                                <h3 class="text-lg font-bold text-slate-800 leading-tight">{{ $ad->title }}</h3>
                                <p class="text-xs text-slate-500">{{ Str::limit($ad->description, 100) }}</p>
                            </div> 
                            <div class="flex gap-2 text-sm">
                                <span class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md"><img src="{{ asset('images/building.svg') }}" class="h-4 w-4"> {{ $ad->propertyType?->name }}</span>
                                <span class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md"><img src="{{ asset('images/bath.svg') }}" class="h-4 w-4"> {{ $ad->bathrooms }} حمام</span>
                                <span class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md"><img src="{{ asset('images/bed.svg') }}" class="h-4 w-4"> {{ $ad->rooms }} غرف نوم</span>
                            </div>
                            <div class="border-t border-gray-100 pt-5 mt-5 flex justify-between items-center">
                                <p class="text-lg font-bold text-indigo-700">{{ number_format($ad->total_price) }} <span class="text-xs font-medium text-slate-500">ر.س {{ $ad->listing_purpose == 'rent' ? '/ شهري' : ''}}</span></p>
                                <a href="{{ route('properties.show', $ad->id) }}" class="bg-[rgba(48,62,124,1)] text-white text-sm font-semibold px-6 py-2.5 rounded-lg hover:bg-indigo-800 transition-colors">رؤية التفاصيل</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="w-full text-center text-gray-500 py-8 col-span-full">هذا المسوق ليس لديه إعلانات حالياً.</p>
            @endforelse
        </div>

        <div class="flex justify-center items-center py-[60px]">
            <!-- Pagination -->
            {{ $ads->links() }}
        </div>
    </section>
</main>
@endsection