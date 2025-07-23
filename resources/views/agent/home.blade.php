{{-- resources/views/agent/home.blade.php --}}

@extends('layouts.agent')

@section('title', 'الرئيسية للوكيل')

@section('content')

    <div class="w-full">
        <div class="bg-[rgba(249,250,252,1)] rounded-2xl p-6 sm:p-8 shadow-sm">

            <!-- Section Title -->
            <div class="text-right mb-6 sm:mb-8">
                <h3 class="text-[22px] font-bold">ملخص إعلاناتك المتبقية</h3>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-y-6">

                <!-- Stat: Featured Ad -->
                <div class="flex flex-col items-center text-center px-2">
                    <p class="text-[rgba(153,153,153,1)] font-bold text-[18.65px]">إعلان مميز</p>
                    <p class="text-[37.3px] font-bold text-[rgba(203,84,75,1)] my-1">5</p>
                    <p class="text-xs text-gray-400">إعلان متبقي</p>
                </div>

                <!-- Stat: Normal Ad -->
                <div class="flex flex-col items-center text-center px-2 border-r-2 border-gray-200 md:border-r-2 mt-0">
                    <p class="text-[rgba(153,153,153,1)] font-bold text-[18.65px]">إعلان عادي</p>
                    <p class="text-[37.3px] font-bold text-[rgba(102,102,102,1)] my-1">7</p>
                    <p class="text-xs text-gray-400">إعلان متبقي</p>
                </div>

                <!-- Stat: Exceptional Ad -->
                <div class="flex flex-col items-center text-center px-2 border-r-2 border-gray-200">
                    <p class="text-[rgba(153,153,153,1)] font-bold text-[18.65px]">إعلان استثنائي</p>
                    <p class="text-[37.3px] font-bold text-[rgba(221,162,80,1)] my-1">3</p>
                    <p class="text-xs text-gray-400">إعلان متبقي</p>
                </div>


                <!-- Stat: Map Ad -->
                <div class="flex flex-col items-center text-center px-2 border-r-2 border-gray-200">
                    <p class="text-[rgba(153,153,153,1)] font-bold text-[18.65px]">إعلان علي الخريطة</p>
                    <p class="text-[37.3px] font-bold text-[rgba(113,183,159,1)] my-1">5</p>
                    <p class="text-xs text-gray-400">إعلان متبقي</p>
                </div>



            </div>
        </div>
    </div>

     <section class=" w-full mx-auto py-8 px-4 lg:px-0">

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


    <!-- Active Ads Section -->
      <section class="w-full py-8">
    <div class="w-full">
        <!-- Section Header - Now responsive -->
        <div class="flex flex-col items-start gap-4 mb-8 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-2xl font-bold font-madani text-rgba(26,26,26,1) sm:text-[26px]">
                اعلانات مفعلة
            </h2>
            <a href="#" class="flex items-center self-stretch gap-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-[rgba(217,222,242,1)] rounded-lg sm:self-auto sm:px-6 sm:py-3 hover:bg-gray-50 transition-colors">
                <span class="font-medium text-[14.64px] text-[rgba(48,62,124,1)]">رؤية الكل</span>
                <img src="images/view-all-arrow.svg" alt="">
            </a>
        </div>

        <!-- Ads Grid - Already responsive, no changes needed here -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

            <!-- Ad Card 1 -->
            <!-- Changed h-[156px] to min-h-[156px] for flexibility on small screens -->
            <div class="bg-[rgba(249,250,252,1)] min-h-[156px] rounded-xl shadow-sm p-5 flex items-center justify-between gap-4">
                <!-- Left Side -->
                <div class="flex flex-col justify-between h-full text-right">
                    <div class="flex flex-col gap-2 text-right">
                    <!-- Responsive font size -->
                    <h3 class="font-semibold text-base sm:text-[17.49px] text-[rgba(26,26,26,1)]">فيلا متشطبة مميزة</h3>
                    <!-- Responsive font size -->
                    <p class="flex items-center gap-1 text-xs sm:text-[12.24px] text-[rgba(26,26,26,1)]">
                        <svg class="w-3 h-3 text-[#303F7C]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                        <span>الرياض - الشرقية</span>
                    </p>
                    </div>
                    <p class="flex items-center gap-1 text-[10.49px] text-[rgba(204,204,204,1)]">
                        <img src="images/clock.svg" alt="">
                        <span>20/6/2025</span>
                    </p>
                </div>
                <!-- Right Side -->

                <div class="flex flex-col items-end justify-between h-full text-left">
                    <!-- Responsive padding and font size -->
                    <span class="text-xs sm:text-[12.55px] font-medium px-3 sm:px-[18px] py-1 rounded-md bg-[rgba(230,230,230,1)] text-[rgba(153,153,153,1)]">عادي</span>
                    <!-- Responsive padding -->
                    <a href="#" class="bg-[rgba(48,62,124,1)] text-white flex items-center gap-3 text-[12px] font-medium px-4 sm:px-6 py-2 rounded-lg hover:bg-opacity-50 transition-colors">
                        <span>رؤية التفاصيل</span>
                        <img src="images/next-arrow.svg" alt="">
                    </a>
                </div>
            </div>

            <!-- Ad Card 2 -->
            <div class="bg-[rgba(249,250,252,1)] min-h-[156px] rounded-xl shadow-sm p-5 flex items-center justify-between gap-4">
                <!-- Left Side -->
                <div class="flex flex-col justify-between h-full text-right">
                    <div class="flex flex-col gap-2 text-right">
                    <h3 class="font-semibold text-base sm:text-[17.49px] text-[rgba(26,26,26,1)]">فيلا متشطبة مميزة</h3>
                    <p class="flex items-center gap-1 text-xs sm:text-[12.24px] text-[rgba(26,26,26,1)]">
                        <svg class="w-3 h-3 text-[#303F7C]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                        <span>الرياض - الشرقية</span>
                    </p>
                    </div>
                    <p class="flex items-center gap-1 text-[10.49px] text-[rgba(204,204,204,1)]">
                        <img src="images/clock.svg" alt="">
                        <span>20/6/2025</span>
                    </p>
                </div>
                <!-- Right Side -->

                <div class="flex flex-col items-end justify-between h-full text-left">
                    <span class="text-xs sm:text-[12.55px] font-medium px-3 sm:px-[18px] py-1 rounded-md bg-[rgba(221,162,80,0.18)] text-[rgba(221,162,80,1)]">مميز</span>
                    <a href="#" class="bg-[rgba(48,62,124,1)] text-white flex items-center gap-3 text-[12px] font-medium px-4 sm:px-6 py-2 rounded-lg hover:bg-opacity-50 transition-colors">
                        <span>رؤية التفاصيل</span>
                        <img src="images/next-arrow.svg" alt="">
                    </a>
                </div>
            </div>
            <!-- Ad Card 3 -->
            <div class="bg-[rgba(249,250,252,1)] min-h-[156px] rounded-xl shadow-sm p-5 flex items-center justify-between gap-4">
                <!-- Left Side -->
                <div class="flex flex-col justify-between h-full text-right">
                    <div class="flex flex-col gap-2 text-right">
                    <h3 class="font-semibold text-base sm:text-[17.49px] text-[rgba(26,26,26,1)]">فيلا متشطبة مميزة</h3>
                    <p class="flex items-center gap-1 text-xs sm:text-[12.24px] text-[rgba(26,26,26,1)]">
                        <svg class="w-3 h-3 text-[#303F7C]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                        <span>الرياض - الشرقية</span>
                    </p>
                    </div>
                    <p class="flex items-center gap-1 text-[10.49px] text-[rgba(204,204,204,1)]">
                        <img src="images/clock.svg" alt="">
                        <span>20/6/2025</span>
                    </p>
                </div>
                <!-- Right Side -->

                <div class="flex flex-col items-end justify-between h-full text-left">
                    <span class="text-xs sm:text-[12.55px] font-medium px-3 sm:px-[18px] py-1 rounded-md bg-[rgba(230,230,230,1)] text-[rgba(153,153,153,1)]">عادي</span>
                    <a href="#" class="bg-[rgba(48,62,124,1)] text-white flex items-center gap-3 text-[12px] font-medium px-4 sm:px-6 py-2 rounded-lg hover:bg-opacity-50 transition-colors">
                        <span>رؤية التفاصيل</span>
                        <img src="images/next-arrow.svg" alt="">
                    </a>
                </div>
            </div>

            <!-- Ad Card 4 -->
            <div class="bg-[rgba(249,250,252,1)] min-h-[156px] rounded-xl shadow-sm p-5 flex items-center justify-between gap-4">
                <!-- Left Side -->
                <div class="flex flex-col justify-between h-full text-right">
                    <div class="flex flex-col gap-2 text-right">
                    <h3 class="font-semibold text-base sm:text-[17.49px] text-[rgba(26,26,26,1)]">فيلا متشطبة مميزة</h3>
                    <p class="flex items-center gap-1 text-xs sm:text-[12.24px] text-[rgba(26,26,26,1)]">
                        <svg class="w-3 h-3 text-[#303F7C]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                        <span>الرياض - الشرقية</span>
                    </p>
                    </div>
                    <p class="flex items-center gap-1 text-[10.49px] text-[rgba(204,204,204,1)]">
                        <img src="images/clock.svg" alt="">
                        <span>20/6/2025</span>
                    </p>
                </div>
                <!-- Right Side -->

                <div class="flex flex-col items-end justify-between h-full text-left">
                    <span class="text-xs sm:text-[12.55px] font-medium px-3 sm:px-[18px] py-1 rounded-md bg-[rgba(230,230,230,1)] text-[rgba(153,153,153,1)]">عادي</span>
                    <a href="#" class="bg-[rgba(48,62,124,1)] text-white flex items-center gap-3 text-[12px] font-medium px-4 sm:px-6 py-2 rounded-lg hover:bg-opacity-50 transition-colors">
                        <span>رؤية التفاصيل</span>
                        <img src="images/next-arrow.svg" alt="">
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
