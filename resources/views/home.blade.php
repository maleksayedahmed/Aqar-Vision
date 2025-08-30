@extends('layouts.app')

@section('title', 'الرئيسية')

@section('content')

<main class="flex flex-col items-center justify-center min-h-screen pt-[35px]">
    <section class="w-[98%] h-[369px] rounded-[20px] shadow-[0_100px_100px_-60px_rgba(0,0,0,0.2)]">
        
        <div class="flex text-center w-[100%] h-[369px] rounded-[20px] items-center flex-col mb-8 bg-[linear-gradient(89.78deg,rgba(44,63,128,0)_0.27%,#4461A6_66.85%,#2C3F80_99.9%)] bg-cover bg-center pt-[40px] pb-[150px]" style="background-image: linear-gradient(89.78deg, rgba(44,63,128,0) 0.27%, #4461A6 66.85%, #2C3F80 99.9%), url('{{ asset('images/homebanner.jpg') }}');">
            <img src="{{ asset('images/logo_sm.png') }}" width="30px" alt="logo">
            
            <!-- Main Title -->
            <div>
                <h1 class="text-[42px] md:text-5xl font-bold text-white mb-4">
                    شُــــفنـا لـك بيــت
                </h1>
                
                <!-- Subtitle -->
                <p class="text-white/90 text-[14px] md:text-xl font-light leading-relaxed max-w-2xl mx-auto">
                    اكتشف عقارات حقيقية بأسعار السوق، وخل قرارك مبني على وضوح <br> وثقة.
                </p>
            </div>
            
        </div>
    </section>

    <!-- Main Form Container -->
<section class="bg-white flex flex-col items-center p-6 rounded-[20px] shadow-sm md:shadow-none mt-[-140px] md:mt-[-100px] w-[80%] lg:w-[878px] h-auto lg:h-auto gap-6 lg:gap-[40px]">
    
    <div class="inline-flex p-1 bg-white border border-gray-200 rounded-xl">
        <button data-tab="buy" data-value="sale" class="toggle-btn px-8 py-2 text-sm font-semibold rounded-lg focus:outline-none transition-colors">
            شراء
        </button>
        <button data-tab="rent" data-value="rent" class="toggle-btn active px-8 py-2 text-sm font-semibold rounded-lg focus:outline-none transition-colors">
            إيجار
        </button>
    </div>

    <form action="{{ route('properties.search') }}" method="GET" class="w-full">
        <input type="hidden" name="listing_purpose" id="listing_purpose_input" value="rent">
        
        <div class="flex flex-col-reverse lg:flex-row-reverse items-center gap-4 w-full">
            
            <button type="submit" class="flex items-center justify-center w-full lg:w-auto h-12 bg-[rgba(48,62,124,1)] text-white font-semibold rounded-lg px-10 hover:bg-indigo-800 focus:outline-none flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <span>بحث</span>
            </button>

            <!-- District Dropdown -->
            <div class="w-full h-12 relative">
                <select name="district_id" id="district-select" class="custom-select-arrow w-full h-full bg-white border border-gray-200 rounded-lg pl-10 pr-4 cursor-pointer hover:border-indigo-400 text-sm font-medium text-gray-700 disabled:bg-gray-100" disabled>
                    <option value="">اختر المدينة أولاً</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center px-3 text-gray-400">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </div>
            </div>
            
            <!-- City Dropdown -->
            <div class="w-full h-12 relative">
                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none"><img src="{{ asset('images/city.svg') }}" alt="City icon"></div>
                <select name="city_id" id="city-select" class="custom-select-arrow w-full h-full bg-white border border-gray-200 rounded-lg pr-12 pl-10 cursor-pointer hover:border-indigo-400 text-sm font-medium text-gray-700">
                    <option value="">المدينة</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center px-3 text-gray-400">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </div>
            </div>
            
            <!-- Property Type Dropdown -->
            <div class="w-full h-12 relative">
                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none"><img src="{{ asset('images/aqar.svg') }}" alt="Property icon"></div>
                <select name="property_type_id" class="custom-select-arrow w-full h-full bg-white border border-gray-200 rounded-lg pr-12 pl-10 cursor-pointer hover:border-indigo-400 text-sm font-medium text-gray-700">
                    <option value="">نوع العقار</option>
                    @foreach($propertyTypes as $propertyType)
                        <option value="{{ $propertyType->id }}">{{ $propertyType->name }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center px-3 text-gray-400">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </div>
            </div>
        </div>
    </form>
</section>

    <section class="max-w-[1325px] w-full mx-auto py-8 px-4 lg:px-0">

        <!-- The Hero Slider Component (The code inside this component is the same) -->
        <div
            x-data="{
                activeSlide: 0,
                slides: [
                    { headline: 'شفنا لك البيت، وبسعر السوق - كل شيء واضح', subheadline: 'مع عقار فيجن' },
                    { headline: 'تحليلات دقيقة وتقارير مفصلة لكل عقار', subheadline: 'لاتخاذ أفضل قرار' },
                    { headline: 'ابحث، قارن، واشترِ بثقة تامة', subheadline: 'مستقبلك يبدأ هنا' }
                ]
            }"
            x-init="setInterval(() => { activeSlide = (activeSlide + 1) % slides.length }, 5000)"
            class="relative rounded-2xl overflow-hidden bg-[rgba(236,238,249,1)] w-full"
        >
            <!-- Subtle background pattern -->
            <div class="absolute bottom-0 left-0 opacity-40">
                <svg width="400" height="400" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="pattern-squares" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                            <rect x="8" y="8" width="4" height="4" fill="#e0e7ff" />
                        </pattern>
                    </defs>
                    <rect x="0" y="0" width="100%" height="100%" fill="url(#pattern-squares)" />
                </svg>
            </div>

            <!-- Main Content Grid -->
            <div class="relative grid grid-cols-1 lg:grid-cols-2 items-center gap-0 lg:gap-8 py-6 px-4 md:py-[60px] md:px-[65px] z-10">

                <!-- Text Content Column -->
                <div class="flex flex-col items-center lg:items-start gap-y-8 text-center lg:text-right">
                    <!-- Logo -->
                    <img src="images/logo.png" class="w-[70px] h-[60px]" alt="logo">

                    <!-- Headline Text Container -->
                    <div class="relative min-h-[120px] md:min-h-[140px] w-full">
                        <template x-for="(slide, index) in slides" :key="index">
                            <div
                                x-show="activeSlide === index"
                                x-transition:enter="transition ease-out duration-500"
                                x-transition:enter-start="opacity-0 transform -translate-y-4"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100 transform translate-y-0"
                                x-transition:leave-end="opacity-0 transform translate-y-4"
                                class="absolute w-full space-y-2"
                            >
                                <h1 class="text-2xl md:text-3xl font-bold text-slate-800" x-text="slide.headline"></h1>
                                <p class="text-2xl md:text-3xl font-bold">
                                    <span class="text-slate-700">مع</span>
                                    <span class="text-indigo-600" x-text="slide.subheadline.split(' ')[1]"></span>
                                </p>
                            </div>
                        </template>
                    </div>
                    
                    <!-- Slider Pagination Dots -->
                    <div class="flex gap-x-2 items-center self-center lg:self-end lg:-ml-[8%]">
                        <template x-for="(slide, index) in slides" :key="index">
                            <button
                                @click="activeSlide = index"
                                class="h-1.5 rounded-full transition-all duration-300"
                                :class="{ 'bg-indigo-600 w-8': activeSlide === index, 'bg-slate-300 w-1.5 hover:bg-slate-400': activeSlide !== index }"
                            ></button>
                        </template>
                    </div>
                </div>

                <!-- Image Column -->
                <div class="hidden lg:flex relative justify-center items-center h-full min-h-[250px] lg:min-h-0">
                    <img src="images/home.png" alt="Modern house with red roof" class="relative lg:absolute mt-8 lg:mt-[150px] lg:-ml-[210px] w-[400px] sm:w-[300px] lg:w-[380px] h-auto object-contain">
                </div>

            </div>
        </div>
            
    </section>

    <section class="max-w-7xl w-[100%] mx-auto py-12 px-4">
        <div class="flex justify-between items-center mb-8">
            <div class="space-y-1">
                <h2 class="text-xl font-bold text-slate-800 md:text-3xl">أحدث العقارات</h2>
                <p class="text-xs sm:text-sm text-slate-500 p   t-2">
                 اكتشف أحدث العروض العقارية المضافة يوميًا
                <br>فلل، شقق، واستوديوهات بتشطيبات مميزة وأسعار منافسة، في أفضل أحياء الرياض والمملكة.
                </p>
                
            </div>
            <a href="{{ route('properties.search') }}" class="text-sm flex items-center gap-2 bg-indigo-50 text-indigo-700 font-semibold px-5 py-2.5 rounded-lg hover:bg-indigo-100 transition-colors">
                <span>رؤية الكل</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7 7-7" /></svg>
            </a>
        </div>
        <div class="relative">
            <button id="nextBtn" class="absolute cursor-pointer top-1/2 left-0 lg:left-[-50px] z-10 transform -translate-y-1/2 bg-[rgba(236,238,249,1)] border border-gray-200 rounded-full p-2 hover:bg-gray-100"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 rotate-180 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></button>
            <button id="prevBtn" class="absolute cursor-pointer top-1/2 right-0 lg:right-[-35px] z-10 transform -translate-y-1/2 bg-[rgba(236,238,249,1)] border border-gray-200 rounded-full p-2 hover:bg-gray-100"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></button>
            <div class="slider-container px-4">
                <div class="slider-track" id="sliderTrack">
                    @forelse ($latestAds as $ad)
                        <div class="slider-card bg-white border border-gray-100 rounded-xl w-[320px] flex-shrink-0 snap-start shadow-sm hover:shadow-lg transition-shadow duration-300">
                            <div>
                                <div class="relative">
                                    <img src="{{ !empty($ad->images) ? Storage::url($ad->images[0]) : 'https://placehold.co/400x300' }}" class="w-full h-48 object-cover rounded-lg" alt="{{ $ad->title }}">
                                    <div class="absolute top-0 left-4 bg-white text-[rgba(48,62,124,1)] text-sm font-medium px-3.5 py-1.5 rounded-b">{{ $ad->listing_purpose == 'rent' ? 'إيجار' : 'بيع' }}</div>
                                    <button class="absolute top-2.5 right-3 bg-[rgba(255,255,255,0.27)] p-1.5 rounded-lg hover:shadow"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[rgba(242,242,242,1)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" /></svg></button>
                                </div>
                                <div class="p-3 space-y-[23px]">
                                    <div class="flex justify-between items-center text-xs text-[rgba(204,204,204,1)]">
                                        <span class="flex items-center gap-0.5 font-semibold text-black"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[rgba(48,62,124,1)]" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 20l-4.95-6.05a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>{{ $ad->district?->city?->name }} - {{ $ad->district?->name }}</span>
                                        <span class="flex items-center gap-0.5"><img src="{{ asset('images/clock.svg') }}"> {{ $ad->created_at->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="space-y-1.5"><h3 class="text-lg font-bold text-slate-800 leading-tight">{{ Str::limit($ad->title, 100) }}</h3><p class="text-xs text-slate-500">{{ Str::limit($ad->description, 40) }}</p></div> 
                                    <div class="flex gap-2 text-sm">
                                        <span class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md"><img src="{{ asset('images/building.svg') }}" class="h-4 w-4"> {{ $ad->propertyType?->name }}</span>
                                        <span class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md"><img src="{{ asset('images/bath.svg') }}" class="h-4 w-4"> {{ $ad->bathrooms }} حمام</span>
                                        <span class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md"><img src="{{ asset('images/bed.svg') }}" class="h-4 w-4"> {{ $ad->rooms }} غرف نوم</span>
                                    </div>
                                    <div class="border-t border-gray-100 pt-5 mt-5 flex justify-between items-center">
                                        <p class="text-lg font-bold text-indigo-700">{{ number_format($ad->total_price) }} <span class="text-xs font-medium text-slate-500">ر.س</span></p>
                                        <a href="{{ route('properties.show', $ad->id) }}" class="bg-[rgba(48,62,124,1)] text-white text-sm font-semibold px-6 py-2.5 rounded-lg hover:bg-indigo-800 transition-colors">رؤية التفاصيل</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="w-full text-center text-gray-500 py-8">لا توجد عقارات متاحة حالياً.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    @if($featuredAds->isNotEmpty())
<section class="max-w-7xl w-full mx-auto py-12 px-4 bg-gray-50 rounded-2xl">
    <div class="flex justify-between items-center mb-8">
        <div class="space-y-1">
            <h2 class="text-xl font-bold text-slate-800 md:text-3xl">أبـرز العقارات</h2>
            <p class="text-xs sm:text-sm text-slate-500">عقارات مميزة نوصي بها.</p>
        </div>
        <a href="{{ route('properties.search', ['type' => 'featured']) }}" class="text-sm flex items-center gap-2 bg-indigo-50 text-indigo-700 font-semibold px-5 py-2.5 rounded-lg hover:bg-indigo-100 transition-colors">
            <span>رؤية الكل</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7 7-7" /></svg>
        </a>
    </div>

    {{-- Grid for Featured Ads --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ($featuredAds as $ad)
            <div class="bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300">
                <div>
                    <div class="relative">
                        <a href="{{ route('properties.show', $ad->id) }}">
                            <img src="{{ !empty($ad->images) ? Storage::url($ad->images[0]) : 'https://placehold.co/400x300' }}" class="w-full h-48 object-cover rounded-t-lg" alt="{{ $ad->title }}">
                        </a>
                        {{-- A slightly different badge for featured items --}}
                        <div class="absolute top-2 right-2 bg-amber-400 text-gray-900 text-xs font-bold px-2 py-1 rounded-full flex items-center gap-1">
                             <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10.868 2.884c.321-.772 1.305-.772 1.626 0l1.373 3.303a1 1 0 00.95.69h3.468c.851 0 1.21.976.544 1.49l-2.807 2.04a1 1 0 00-.364 1.118l1.07 3.303c.321.772-.639 1.42-1.34 1.01l-2.807-2.04a1 1 0 00-1.175 0l-2.807 2.04c-.701.41-1.66-.238-1.34-1.01l1.07-3.303a1 1 0 00-.364-1.118l-2.807-2.04c-.666-.514-.307-1.49.544-1.49h3.468a1 1 0 00.95-.69l1.373-3.303z" clip-rule="evenodd" /></svg>
                            <span>مميز</span>
                        </div>
                    </div>
                    <div class="p-4 space-y-3">
                         <h3 class="text-lg font-bold text-slate-800 leading-tight">{{ Str::limit($ad->title, 100) }}</h3>
                         <div class="flex justify-between items-center">
                            <p class="text-lg font-bold text-indigo-700">{{ number_format($ad->total_price) }} <span class="text-xs font-medium text-slate-500">ر.س</span></p>
                            <a href="{{ route('properties.show', $ad->id) }}" class="bg-[rgba(48,62,124,1)] text-white text-sm font-semibold px-5 py-2 rounded-lg hover:bg-indigo-800 transition-colors">التفاصيل</a>
                         </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif

    <section class="py-10 w-[98%] bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-xl font-bold text-slate-800 md:text-3xl">وكلاء العقارات</h2>
                <a href="#" class="text-sm flex items-center gap-2 bg-indigo-50 text-indigo-700 font-semibold px-5 py-2.5 rounded-lg hover:bg-indigo-100 transition-colors">
                    <span>رؤية الكل</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7 7-7" /></svg>
                </a>
            </div>
            <div class="relative">
                <div id="gradient-left" class="absolute top-0 right-0 h-full w-24 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none transition-opacity duration-300 opacity-0"></div>
                <div id="gradient-right" class="absolute top-0 left-0 h-full w-24 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none transition-opacity duration-300"></div>
                <div id="agents-slider" class="flex overflow-x-auto gap-5 cursor-grab active:cursor-grabbing select-none px-4 sm:pl-6 lg:pl-8" style="scrollbar-width: none;">
                    @forelse($agents as $agent)
                        <div class="bg-[rgba(247,249,250,1)] p-5 rounded-2xl flex flex-col gap-2 min-w-[380px]">
                            <div class="self-end"><span class="bg-[#e6f6f0] text-[#1d8e5a] text-[11px] font-medium px-2 py-1 rounded-md">مسوق عقاري</span></div>
                            <div class="flex items-center gap-1 text-[rgba(48,62,124,1)]">
                                <img src="{{ $agent->profile_photo_path ? Storage::url($agent->profile_photo_path) : asset('images/agent.png') }}" alt="{{ $agent->name }}" class="w-16 h-16 rounded-full object-cover border-2 border-white">
                                <div class="space-y-1">
                                    
                                    <div class="flex items-center gap-0.5 text-slate-500 text-[9px]">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-[rgba(217,222,242,1)]" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 20l-4.95-6.05a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                        </svg>
                                        <span>{{ $agent->agent?->city?->name ?? 'غير محدد' }}</span>
                                    </div>
                                    <h3 class="font-medium text-lg text-[rgba(48,62,124,1)]">{{ $agent->name }}</h3></div>
                            </div>
                            <div class="flex justify-between items-center gap-[60px] pt-2">
                                <div class="flex items-center gap-1.5 text-[rgba(48,62,124,1)] text-[8px] font-medium"><svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.75391 8.60121H3.31641V5.44201L1.75391 4.74756V8.60121ZM2.63281 5.76918H3.02344V6.35512H2.63281V5.76918ZM2.63281 6.55043H3.02344V7.13637H2.63281V6.55043ZM2.63281 7.33168H3.02344V7.91762H2.63281V7.33168ZM2.04688 5.76918H2.4375V6.35512H2.04688V5.76918ZM2.04688 6.55043H2.4375V7.13637H2.04688V6.55043ZM2.04688 7.33168H2.4375V7.91762H2.04688V7.33168Z" fill="#303E7C"/><path d="M-0.00390625 8.60121H1.55859V4.74756L-0.00390625 5.44201V8.60121ZM0.875 5.76918H1.26562V6.35512H0.875V5.76918ZM0.875 6.55043H1.26562V7.13637H0.875V6.55043ZM0.875 7.33168H1.26562V7.91762H0.875V7.33168ZM0.289062 5.76918H0.679688V6.35512H0.289062V5.76918ZM0.289062 6.55043H0.679688V7.13637H0.289062V6.55043ZM0.289062 7.33168H0.679688V7.91762H0.289062V7.33168Z" fill="#303E7C"/><path d="M2.33976 4.79273C2.33976 4.79326 2.3396 4.79377 2.3396 4.7943L3.45364 5.28943C3.48892 5.30512 3.51163 5.3401 3.51163 5.37867V8.60133H5.07413V0.436035L2.33976 1.3475V4.79273ZM3.99991 1.47242L4.78116 1.27711V1.66773L3.99991 1.86305V1.47242ZM3.99991 2.05836L4.78116 1.86305V2.25367L3.99991 2.44898V2.05836ZM3.99991 2.6443L4.78116 2.44898V2.83961L3.99991 3.03492V2.6443ZM3.99991 3.23023L4.78116 3.03492V3.42555L3.99991 3.62086V3.23023ZM3.99991 3.81617L4.78116 3.62086V4.01148L3.99991 4.2068V3.81617ZM3.99991 4.40211L4.78116 4.2068V4.59742L3.99991 4.79273V4.40211ZM3.99991 4.98805L4.78116 4.79273V5.18336L3.99991 5.37867V4.98805ZM3.99991 5.57398L4.78116 5.37867V5.7693L3.99991 5.96461V5.57398ZM2.82804 1.86305L3.60929 1.66773V2.05836L2.82804 2.25367V1.86305ZM2.82804 2.44898L3.60929 2.25367V2.6443L2.82804 2.83961V2.44898ZM2.82804 3.03492L3.60929 2.83961V3.23023L2.82804 3.42555V3.03492ZM2.82804 3.62086L3.60929 3.42555V3.81617L2.82804 4.01148V3.62086Z" fill="#303E7C"/><path d="M5.26953 0.436035V8.60133H8.00391V1.3475L5.26953 0.436035ZM6.34375 5.96461L5.5625 5.7693V5.37867L6.34375 5.57398V5.96461ZM6.34375 5.37867L5.5625 5.18336V4.79273L6.34375 4.98805V5.37867ZM6.34375 4.79273L5.5625 4.59742V4.2068L6.34375 4.40211V4.79273ZM6.34375 4.2068L5.5625 4.01148V3.62086L6.34375 3.81617V4.2068ZM6.34375 3.62086L5.5625 3.42555V3.03492L6.34375 3.23023V3.62086ZM6.34375 3.03492L5.5625 2.83961V2.44898L6.34375 2.6443V3.03492ZM6.34375 2.44898L5.5625 2.25367V1.86305L6.34375 2.05836V2.44898ZM6.34375 1.86305L5.5625 1.66773V1.27711L6.34375 1.47242V1.86305ZM7.51562 6.35523L6.73438 6.15992V5.7693L7.51562 5.96461V6.35523ZM7.51562 5.7693L6.73438 5.57398V5.18336L7.51562 5.37867V5.7693ZM7.51562 5.18336L6.73438 4.98805V4.59742L7.51562 4.79273V5.18336ZM7.51562 4.59742L6.73438 4.40211V4.01148L7.51562 4.2068V4.59742ZM7.51562 4.01148L6.73438 3.81617V3.42555L7.51562 3.62086V4.01148ZM7.51562 3.42555L6.73438 3.23023V2.83961L7.51562 3.03492V3.42555ZM7.51562 2.83961L6.73438 2.6443V2.25367L7.51562 2.44898V2.83961ZM7.51562 2.25367L6.73438 2.05836V1.66773L7.51562 1.86305V2.25367Z" fill="#303E7C"/></svg>                  
                                    <span>+{{ $agent->ads_count }} عقار</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <a href="tel:{{ $agent->phone }}" class="h-[27px] px-3 flex items-center gap-2 rounded-lg bg-[rgba(48,63,125,1)] text-white hover:bg-indigo-800 transition-colors text-xs font-normal"><span>اتصل بنا</span></a>
                                    <a href="{{ route('agents.show', $agent) }}" class="h-[27px] px-3 flex items-center gap-2 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-200/50 transition-colors text-xs font-normal"><span>تواصل معنا</span></a>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $agent->phone) }}" title="WhatsApp" class="flex items-center justify-center w-[34px] h-[27px] rounded-lg bg-[#25D366] text-white hover:bg-[#1EAE54] transition-colors"><svg width="13.5" height="13.5" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.00001 0.78125C3.28935 0.78125 0.281261 3.78934 0.281261 7.5C0.281261 8.42556 0.468681 9.30855 0.808083 10.1122C0.897118 10.323 0.95714 10.4654 0.99723 10.5749C1.03812 10.6865 1.04386 10.7269 1.04458 10.7373C1.04865 10.796 1.03379 10.8758 0.93245 11.2546L0.297189 13.6288C0.253919 13.7906 0.300179 13.9631 0.418554 14.0815C0.53693 14.1998 0.70945 14.2461 0.87117 14.2028L3.2454 13.5676C3.62417 13.4662 3.70397 13.4514 3.76266 13.4554C3.77307 13.4561 3.81346 13.4619 3.92512 13.5028C4.03459 13.5429 4.17704 13.6029 4.38785 13.6919C5.19146 14.0313 6.07445 14.2188 7.00001 14.2188C10.7107 14.2188 13.7188 11.2107 13.7188 7.5C13.7188 3.78934 10.7107 0.78125 7.00001 0.78125ZM5.10806 3.90626L5.05015 3.9062C4.75036 3.90569 4.47381 3.90523 4.20182 4.02946C4.00422 4.11972 3.83609 4.27307 3.71366 4.42622C3.59123 4.57938 3.47869 4.77716 3.43417 4.98979C3.37314 5.28125 3.42347 5.50302 3.4773 5.74026L3.48474 5.77307C3.75631 6.97575 4.3912 8.15504 5.36796 9.13179C6.34471 10.1086 7.524 10.7434 8.72668 11.015L8.75949 11.0224C8.99673 11.0763 9.2185 11.1266 9.50996 11.0656C9.72259 11.0211 9.92037 10.9085 10.0735 10.7861C10.2267 10.6637 10.38 10.4955 10.4703 10.2979C10.5945 10.0259 10.5941 9.74939 10.5935 9.4496L10.5935 9.39169C10.5935 9.25395 10.5892 9.022 10.4999 8.80762C10.3932 8.55151 10.1733 8.34043 9.82865 8.28642L9.82507 8.28586C9.39799 8.21893 9.07315 8.16802 8.84352 8.13464C8.72858 8.11793 8.63318 8.10497 8.55855 8.09649C8.4972 8.08953 8.41279 8.08077 8.34219 8.0849C8.03621 8.10281 7.79286 8.22692 7.60437 8.35609C7.48441 8.4383 7.35406 8.54839 7.25156 8.63496C7.2113 8.66897 7.17534 8.69934 7.14599 8.72297L7.09762 8.76191C6.9131 8.91048 6.82083 8.98477 6.70706 8.98243C6.59329 8.98009 6.50982 8.90703 6.34289 8.76091C6.23669 8.66795 6.13259 8.5706 6.03087 8.46888C5.92915 8.36716 5.8318 8.26306 5.73884 8.15686C5.59272 7.98993 5.51966 7.90646 5.51732 7.79269C5.51498 7.67892 5.58926 7.58665 5.73784 7.40213L5.77678 7.35376C5.80041 7.32441 5.83079 7.28845 5.86479 7.24819C5.95136 7.14569 6.06146 7.01534 6.14366 6.89538C6.27283 6.70689 6.39694 6.46354 6.41485 6.15756C6.41898 6.08696 6.41022 6.00255 6.40325 5.9412C6.39478 5.86657 6.38182 5.77117 6.36511 5.65623C6.33173 5.42655 6.28084 5.10188 6.21389 4.67466L6.21333 4.6711C6.15932 4.32645 5.94824 4.10658 5.69213 3.99985C5.47775 3.91052 5.2458 3.90626 5.10806 3.90626Z" fill="white"/></svg></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="w-full text-center text-gray-500 py-8">لا يوجد وكلاء عقارات متاحون حالياً.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

     <!-- world section -->
    <section class="my-16 flex justify-center px-4">
        <div class="w-full lg:w-[1120px] text-center p-6 md:p-8 lg:p-12 rounded-2xl bg-cover bg-center" style="background-image: url('images/world.png'); background-color: rgba(68, 112, 174, 1);">
            
            <h2 class="text-white text-2xl md:text-3xl lg:text-4xl font-bold mb-6">
                لديك عقار للبيع أو الإيجار؟ ابدأ إعلانك هنا!
            </h2>
            
            <p class="text-white/90 text-base lg:text-lg mb-8 max-w-3xl mx-auto font-medium leading-relaxed">
                يمكنك الآن إصدار رخصة إعلان لعقارك والوصول إلى آلاف المشترين أو المستأجرين المحتملين بكل سهولة. لديك حتى 3 إعلان متاح كحد أقصى لحسابك.
            </p>
            
            <a href="{{ route('user.ads.create') }}" class="inline-block bg-[#2C3F80] text-white font-semibold py-3 px-10 rounded-full hover:bg-opacity-90 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[#4A6C9B] focus:ring-white">
                إصدار ترخيص اعلان
            </a>
            
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Buy/Rent Toggle Button Logic
        const buttons = document.querySelectorAll('.toggle-btn');
        if (buttons.length) {
            const activeClasses = ['bg-indigo-100', 'text-indigo-700', 'shadow-sm'];
            const inactiveClasses = ['text-gray-500', 'hover:bg-gray-50'];
            
            function setInitialState() {
                buttons.forEach(button => {
                    if (button.classList.contains('active')) {
                        button.classList.add(...activeClasses);
                        button.classList.remove(...inactiveClasses);
                    } else {
                        button.classList.add(...inactiveClasses);
                        button.classList.remove(...activeClasses);
                    }
                });
            }
            const listingPurposeInput = document.getElementById('listing_purpose_input');
            buttons.forEach(clickedButton => {
                clickedButton.addEventListener('click', () => {
                    if (listingPurposeInput) {
                    listingPurposeInput.value = clickedButton.dataset.value;
                    }
                    buttons.forEach(button => {
                        button.classList.remove('active', ...activeClasses);
                        button.classList.add(...inactiveClasses);
                    });
                    clickedButton.classList.add('active', ...activeClasses);
                    clickedButton.classList.remove(...inactiveClasses);
                });
            });
            setInitialState();
        }

        
                // Property slider functionality
    const sliderTrack = document.getElementById('sliderTrack');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const cards = document.querySelectorAll('.slider-card');
    
    let currentIndex = 0;
    const cardWidth = 320; // Card width in pixels
    const gap = 16; // Gap between cards (assuming 1rem = 16px)
    const slideDistance = cardWidth + gap;
    const maxIndex = cards.length - 1;
    
    // Function to update slider position
    function updateSliderPosition() {
        const translateX = currentIndex * slideDistance;
        sliderTrack.style.transform = `translateX(${translateX}px)`;
        
        // Update button states
        prevBtn.style.opacity = currentIndex === 0 ? '0.5' : '1';
        nextBtn.style.opacity = currentIndex === maxIndex ? '0.5' : '1';
        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex === maxIndex;
    }
    
    // Next button click handler
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            
            if (currentIndex < maxIndex) {
                currentIndex++;
                updateSliderPosition();
            }
        });
    }
    
    // Previous button click handler
    prevBtn.addEventListener('click', function() {
        if (currentIndex > 0) {
            currentIndex--;
            updateSliderPosition();
        }
    });
    
    // Initialize slider
    updateSliderPosition();
    
    
    // Optional: Add touch/swipe support for mobile
    let startX = 0;
    let currentX = 0;
    let isDragging = false;
    
    sliderTrack.addEventListener('touchstart', function(e) {
        startX = e.touches[0].clientX;
        isDragging = true;
    });
    
    sliderTrack.addEventListener('touchmove', function(e) {
        if (!isDragging) return;
        currentX = e.touches[0].clientX;
        e.preventDefault();
    });
    
    sliderTrack.addEventListener('touchend', function() {
        if (!isDragging) return;
        isDragging = false;
        
        const diffX = startX - currentX;
        const threshold = 50; // Minimum swipe distance
        
        if (Math.abs(diffX) > threshold) {
            if (diffX > 0 && currentIndex < maxIndex) {
                // Swipe left - go to next
                currentIndex++;
                updateSliderPosition();
            } else if (diffX < 0 && currentIndex > 0) {
                // Swipe right - go to previous
                currentIndex--;
                updateSliderPosition();
            }
        }
    }); 

        // Agents Slider Functionality
        const agentsSlider = document.querySelector('#agents-slider');
        if (agentsSlider) {
            let isDown = false, startX, scrollLeft;
            agentsSlider.addEventListener('mousedown', (e) => { isDown = true; agentsSlider.classList.add('active'); startX = e.pageX - agentsSlider.offsetLeft; scrollLeft = agentsSlider.scrollLeft; });
            agentsSlider.addEventListener('mouseleave', () => { isDown = false; agentsSlider.classList.remove('active'); });
            agentsSlider.addEventListener('mouseup', () => { isDown = false; agentsSlider.classList.remove('active'); });
            agentsSlider.addEventListener('mousemove', (e) => { if (isDown) { e.preventDefault(); const x = e.pageX - agentsSlider.offsetLeft; agentsSlider.scrollLeft = scrollLeft - (x - startX) * 2; } });
        }
    });
</script>
@endpush