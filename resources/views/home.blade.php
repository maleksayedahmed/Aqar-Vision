{{-- resources/views/home.blade.php --}}

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
    <section class="bg-white flex flex-col items-center p-6 rounded-[20px] shadow-sm md:shadow-none mt-[-140px] md:mt-[-100px] w-[80%] lg:w-[878px] h-auto lg:h-[166px] gap-6 lg:gap-[40px]">
        
        <div class="inline-flex p-1 bg-white border border-gray-200 rounded-xl">
            <button data-tab="buy" class="toggle-btn px-8 py-2 text-sm font-semibold rounded-lg focus:outline-none transition-colors">
                شراء
            </button>
            <button data-tab="rent" class="toggle-btn active px-8 py-2 text-sm font-semibold rounded-lg focus:outline-none transition-colors">
                إيجار
            </button>
        </div>

        <div class="flex flex-col-reverse lg:flex-row-reverse items-center gap-4 w-full">
            <button class="flex items-center justify-center w-full lg:w-auto h-12 bg-[rgba(48,62,124,1)] text-white font-semibold rounded-lg px-10 hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <span>بحث</span>
            </button>

            <div class="flex items-center justify-between w-full h-12 bg-white border border-gray-200 rounded-lg px-4 cursor-pointer hover:border-indigo-400 transition-colors">
                <span class="text-sm font-medium text-gray-700">الحي</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>

            <div class="flex items-center justify-between w-full h-12 bg-white border border-gray-200 rounded-lg px-4 cursor-pointer hover:border-indigo-400 transition-colors">
                <div class="flex items-center gap-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-300" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 20l-4.95-6.05a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm font-medium text-gray-700">المدينة</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
            
            <div class="flex items-center justify-between w-full h-12 bg-white border border-gray-200 rounded-lg px-4 cursor-pointer hover:border-indigo-400 transition-colors">
                <div class="flex items-center gap-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-300" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm3 1a1 1 0 00-1 1v1a1 1 0 001 1h1a1 1 0 001-1V7a1 1 0 00-1-1H5zM5 11a1 1 0 00-1 1v1a1 1 0 001 1h1a1 1 0 001-1v-1a1 1 0 00-1-1H5zM9 7a1 1 0 00-1 1v1a1 1 0 001 1h1a1 1 0 001-1V7a1 1 0 00-1-1H9zM9 11a1 1 0 00-1 1v1a1 1 0 001 1h1a1 1 0 001-1v-1a1 1 0 00-1-1H9zM13 7a1 1 0 00-1 1v1a1 1 0 001 1h1a1 1 0 001-1V7a1 1 0 00-1-1h-1zM13 11a1 1 0 00-1 1v1a1 1 0 001 1h1a1 1 0 001-1v-1a1 1 0 00-1-1h-1z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">نوع العقار</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </section>

    <section class="max-w-[1325px] w-full mx-auto py-8 px-4 lg:px-0">

        <!-- The Hero Slider Component -->
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
                    <img src="{{ asset('images/logo.png') }}" class="w-[70px] h-[60px]" alt="logo">

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
                    <img src="{{ asset('images/home.png') }}" alt="Modern house with red roof" class="relative lg:absolute mt-8 lg:mt-[150px] lg:-ml-[210px] w-[400px] sm:w-[300px] lg:w-[380px] h-auto object-contain">
                </div>

            </div>
        </div>
            
    </section>


    <section class="max-w-7xl w-[100%] mx-auto py-12 px-4">
        <div class="flex justify-between items-center mb-8">
            <div class="space-y-1">
            <h2 class="text-xl font-bold text-slate-800 md:text-3xl">أحدث العقارات</h2>
            <p class="text-xs sm:text-sm text-slate-500">اكتشف أحدث العروض العقارية المضافة يوميًا.</p>
            </div>
            <a href="#" class="text-sm flex items-center gap-2 bg-indigo-50 text-indigo-700 font-semibold px-5 py-2.5 rounded-lg hover:bg-indigo-100 transition-colors">
                <span>رؤية الكل</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7 7-7" />
            </svg>
        </a>
        </div>

        <div class="relative">
            <button id="nextBtn" class="absolute cursor-pointer top-1/2 left-0 lg:left-[-50px] z-10 transform -translate-y-1/2 bg-[rgba(236,238,249,1)] border border-gray-200 rounded-full p-2 hover:bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 rotate-180 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            </button>
            <button id="prevBtn" class="absolute cursor-pointer top-1/2 right-0 lg:right-[-35px] z-10 transform -translate-y-1/2 bg-[rgba(236,238,249,1)] border border-gray-200 rounded-full p-2 hover:bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            </button>
            

        <div class="slider-container px-4">
            <div class="slider-track" id="sliderTrack">
                <!-- Card 1: Apartment (For Rent) -->
                    <div class="slider-card bg-white border border-gray-100 rounded-xl w-[320px] flex-shrink-0 snap-start shadow-sm hover:shadow-lg transition-shadow duration-300">
                        <div>
                            <!-- Image Section -->
                            <div class="relative">
                                <img src="https://images.pexels.com/photos/323780/pexels-photo-323780.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="w-full h-48 object-cover rounded-lg" alt="شقة مميزة للإيجار">
                                <div class="absolute top-0 left-4 bg-white text-[rgba(48,62,124,1)] text-sm font-medium px-3.5 py-1.5 rounded-b">إيجار</div>
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
                                        الرياض - النسيم الشرقي
                                    </span>
                                    <span class="flex items-center gap-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none"><g clip-path="url(#clip0_527_766)"><path d="M7.4856 9.17121V10.145C7.4856 10.1979 7.5287 10.241 7.5816 10.241C7.63451 10.241 7.67761 10.1979 7.67761 10.145V9.17121C7.67761 9.1183 7.63451 9.0752 7.5816 9.0752C7.5287 9.0752 7.4856 9.1183 7.4856 9.17121Z" fill="#CCCCCC"/><path d="M10.5173 6.13947C10.5173 6.19237 10.5604 6.23548 10.6133 6.23548H11.5872C11.6401 6.23548 11.6832 6.19237 11.6832 6.13947C11.6832 6.08656 11.6401 6.04346 11.5872 6.04346H10.6133C10.5604 6.04346 10.5173 6.08656 10.5173 6.13947Z" fill="#CCCCCC"/><path d="M7.58182 0.570312C4.91103 0.570312 2.6089 2.49595 2.11475 5.09026H3.30111C3.77369 3.1254 5.52873 1.72922 7.58182 1.72922C10.0153 1.72922 11.9939 3.7078 11.9939 6.13935C11.9939 8.57287 10.0153 10.5514 7.58182 10.5514C6.18956 10.5514 4.89731 9.90434 4.06979 8.80622C3.95214 8.92387 3.8286 9.02388 3.70506 9.10624L3.75604 9.21802C4.25216 9.56706 4.74239 10.2142 5.0032 11.0789C5.79345 11.4927 6.67391 11.7084 7.58182 11.7084C10.6526 11.7084 13.1509 9.21017 13.1509 6.13935C13.1509 3.06854 10.6526 0.570312 7.58182 0.570312Z" fill="#CCCCCC"/><path d="M7.67761 3.10889V2.13312C7.67761 2.08022 7.63451 2.03711 7.5816 2.03711C7.5287 2.03711 7.4856 2.08022 7.4856 2.13312V3.10693C7.4856 3.15983 7.5287 3.20294 7.5816 3.20294C7.63451 3.2049 7.67761 3.16179 7.67761 3.10889Z" fill="#CCCCCC"/><path d="M8.92882 2.98575C8.96605 2.98575 9.00328 2.9642 9.01699 2.92697L9.20313 2.47632C9.22273 2.42733 9.19922 2.37051 9.15023 2.35092C9.10125 2.33132 9.04442 2.35287 9.02483 2.40382L8.83869 2.85448C8.8191 2.90346 8.84261 2.96028 8.89159 2.97988C8.90335 2.98379 8.91707 2.98575 8.92882 2.98575Z" fill="#CCCCCC"/><path d="M10.0702 3.74921C10.0957 3.74921 10.1192 3.73941 10.1388 3.72176L10.484 3.37663C10.5212 3.33938 10.5212 3.27859 10.484 3.23937C10.4467 3.20211 10.3859 3.20211 10.3467 3.23937L10.0016 3.58449C9.96432 3.62175 9.96432 3.68254 10.0016 3.72176C10.0212 3.73941 10.0467 3.74921 10.0702 3.74921Z" fill="#CCCCCC"/><path d="M10.8329 4.88993C10.8446 4.88993 10.8583 4.88797 10.8701 4.88209L11.3208 4.69595C11.3697 4.67635 11.3932 4.61953 11.3737 4.57055C11.3541 4.52156 11.2972 4.49805 11.2483 4.51764L10.7976 4.70379C10.7486 4.72338 10.7251 4.7802 10.7447 4.82919C10.7604 4.86837 10.7956 4.88993 10.8329 4.88993Z" fill="#CCCCCC"/><path d="M10.8701 7.39828C10.8211 7.37868 10.7643 7.40024 10.7447 7.45118C10.7251 7.50017 10.7486 7.55699 10.7976 7.57658L11.2483 7.76272C11.26 7.7686 11.2737 7.77056 11.2855 7.77056C11.3227 7.77056 11.3599 7.74901 11.3737 7.71178C11.3932 7.66279 11.3697 7.60597 11.3208 7.58638L10.8701 7.39828Z" fill="#CCCCCC"/><path d="M10.0016 8.69646L10.3467 9.04158C10.3663 9.06119 10.3898 9.06903 10.4153 9.06903C10.4408 9.06903 10.4644 9.05923 10.484 9.04158C10.5212 9.00432 10.5212 8.94354 10.484 8.90432L10.1388 8.55919C10.1016 8.52194 10.0408 8.52194 10.0016 8.55919C9.96432 8.59841 9.96432 8.6592 10.0016 8.69646Z" fill="#CCCCCC"/><path d="M8.89159 9.30261C8.84261 9.3222 8.8191 9.37902 8.83869 9.42801L9.02483 9.87866C9.04051 9.91589 9.07577 9.93744 9.113 9.93744C9.12476 9.93744 9.13847 9.93548 9.15023 9.92961C9.19922 9.91001 9.22273 9.85319 9.20313 9.80421L9.01699 9.35355C8.9974 9.30456 8.94058 9.28301 8.89159 9.30261Z" fill="#CCCCCC"/><path d="M6.01295 9.93127C6.02471 9.93715 6.03842 9.9391 6.05018 9.9391C6.08741 9.9391 6.12463 9.91755 6.13835 9.88032L6.32449 9.42967C6.34408 9.38068 6.32057 9.32386 6.27159 9.30427C6.2226 9.28467 6.16578 9.30818 6.14619 9.35717L5.96005 9.80783C5.94045 9.85289 5.96201 9.90971 6.01295 9.93127Z" fill="#CCCCCC"/><path d="M5.02663 8.56115L4.68151 8.90628C4.64425 8.94353 4.64425 9.00432 4.68151 9.04354C4.70112 9.06315 4.72465 9.07099 4.75014 9.07099C4.77563 9.07099 4.79916 9.06119 4.81877 9.04354L5.1639 8.69842C5.20115 8.66116 5.20115 8.60037 5.1639 8.56115C5.12468 8.52193 5.06389 8.52193 5.02663 8.56115Z" fill="#CCCCCC"/><path d="M4.29489 4.88235C4.30664 4.88822 4.32036 4.89018 4.33212 4.89018C4.36934 4.89018 4.40657 4.86863 4.42029 4.8314C4.43988 4.78242 4.41637 4.7256 4.36738 4.706L3.91673 4.51986C3.86774 4.50027 3.81092 4.52182 3.79133 4.57276C3.77173 4.62175 3.79525 4.67857 3.84423 4.69816L4.29489 4.88235Z" fill="#CCCCCC"/><path d="M5.09331 3.74921C5.1188 3.74921 5.14233 3.73941 5.16194 3.72176C5.1992 3.6845 5.1992 3.62371 5.16194 3.58449L4.81682 3.23937C4.77956 3.20211 4.71877 3.20211 4.67955 3.23937C4.6423 3.27663 4.6423 3.33742 4.67955 3.37663L5.02468 3.72176C5.04429 3.73941 5.06978 3.74921 5.09331 3.74921Z" fill="#CCCCCC"/><path d="M6.14617 2.92476C6.16184 2.96199 6.19711 2.98354 6.23434 2.98354C6.2461 2.98354 6.25981 2.98159 6.27157 2.97571C6.32055 2.95611 6.34407 2.89929 6.32447 2.85031L6.13833 2.39965C6.11874 2.35067 6.06192 2.32715 6.01293 2.34675C5.96395 2.36634 5.94043 2.42316 5.96003 2.47215L6.14617 2.92476Z" fill="#CCCCCC"/><path d="M7.34055 4.03174V5.65931C7.16407 5.74755 7.04053 5.92992 7.04053 6.1417C7.04053 6.43976 7.28172 6.68292 7.58174 6.68292C7.64057 6.68292 7.69744 6.67115 7.75038 6.6535L9.4662 8.36932C9.5113 8.41442 9.57209 8.43991 9.6368 8.43991C9.70151 8.43991 9.7623 8.41442 9.8074 8.36932C9.90152 8.27519 9.90152 8.12224 9.8074 8.02812L8.09159 6.3123C8.10923 6.25936 8.121 6.20249 8.121 6.1417C8.121 5.92992 7.99942 5.74952 7.82294 5.66127V4.0337C7.82294 3.90232 7.71313 3.79251 7.58174 3.79251C7.45036 3.79055 7.34055 3.8984 7.34055 4.03174Z" fill="#CCCCCC"/><path d="M5.05998 12.3029H4.9992C4.96782 10.8184 4.2011 9.6458 3.44222 9.24773C3.40496 9.22812 3.38143 9.18694 3.38143 9.14184C3.38143 9.09674 3.40496 9.05752 3.44222 9.03791C4.2011 8.63788 4.96782 7.46721 4.9992 5.98278H5.05998C5.19921 5.98278 5.31294 5.86905 5.31294 5.72982V5.53765C5.31294 5.39843 5.19921 5.28469 5.05998 5.28469H0.85379C0.714564 5.28273 0.60083 5.39647 0.60083 5.53765V5.72982C0.60083 5.86905 0.714564 5.98278 0.85379 5.98278H0.912618C0.943993 7.46917 1.71268 8.64181 2.47156 9.03791C2.50881 9.05752 2.53235 9.0987 2.53235 9.1438C2.53235 9.1889 2.50881 9.23008 2.47156 9.24969C1.71268 9.64776 0.943993 10.8184 0.912618 12.3048H0.85379C0.714564 12.3029 0.60083 12.4166 0.60083 12.5578V12.75C0.60083 12.8892 0.714564 13.0029 0.85379 13.0029H5.05998C5.19921 13.0029 5.31294 12.8892 5.31294 12.75V12.5578C5.31294 12.4166 5.19921 12.3029 5.05998 12.3029ZM1.22244 12.3029C1.25382 10.9518 1.95387 9.86739 2.61667 9.5203C2.75589 9.44775 2.84413 9.30264 2.84413 9.14184C2.84413 8.98105 2.75785 8.83594 2.61863 8.76338C1.95779 8.41826 1.25774 7.3319 1.22441 5.98082H4.69329C4.66192 7.32798 3.96186 8.4163 3.30103 8.76338C3.1618 8.83594 3.07552 8.98105 3.07552 9.14184C3.07552 9.30264 3.1618 9.44775 3.30103 9.5203C3.96186 9.86739 4.66192 10.9537 4.69329 12.3029H1.22244Z" fill="#CCCCCC"/><path d="M4.27956 6.83348C4.27956 6.82564 4.27956 6.81583 4.2776 6.80799C3.84031 6.77662 3.6952 6.88643 3.12457 7.11782C2.69316 7.29234 2.02645 7.07468 1.63818 6.93545C1.69113 7.83552 2.3951 8.5493 2.95985 8.5493C3.54225 8.5493 4.27956 7.78061 4.27956 6.83348Z" fill="#CCCCCC"/><path d="M1.49512 11.997H4.41886C4.25022 11.297 3.64626 10.7773 2.95601 10.7773C2.26576 10.7773 1.66376 11.297 1.49512 11.997Z" fill="#CCCCCC"/></g><defs><clipPath id="clip0_527_766"><rect width="12.55" height="12.55" fill="white" transform="translate(0.60083 0.511719)"/></clipPath></defs></svg>
                                        20/6/2025
                                    </span>
                                </div>
                                <div class="space-y-1.5">
                                <h3 class="text-lg font-bold text-slate-800 leading-tight">شقة مميزة للإيجار</h3>
                                <p class="text-xs text-slate-500">مساحة مريحة وتشطيب نظيف. موقع هادئ وقريب من جميع الخدمات...</p>
                                </div> 
                                <div class="flex gap-2 text-sm">
                                    <span class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md"><img src="{{ asset('images/building.svg') }}" class="h-4 w-4"> شقة</span>
                                    <span class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md"><img src="{{ asset('images/bath.svg') }}" class="h-4 w-4"> 3 حمام</span>
                                    <span class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md"><img src="{{ asset('images/bed.svg') }}" class="h-4 w-4"> 2 غرفة نوم</span>
                                </div>
                                <div class="border-t border-gray-100 pt-5 mt-5 flex justify-between items-center">
                                    <p class="text-lg font-bold text-indigo-700">1,500 <span class="text-xs font-medium text-slate-500">ر.س / شهري</span></p>
                                    <a href="#" class="bg-[rgba(48,62,124,1)] text-white text-sm font-semibold px-6 py-2.5 rounded-lg hover:bg-indigo-800 transition-colors">رؤية التفاصيل</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Add more property cards as needed --}}
            </div>
        </div>
    </div>
    </section>



    <!-- Agents Section -->
    <section class="py-10 w-[98%] bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">
            <h2 class="text-xl font-bold text-slate-800 md:text-3xl">وكلاء العقارات</h2>
            <a href="#" class="text-sm flex items-center gap-2 bg-indigo-50 text-indigo-700 font-semibold px-5 py-2.5 rounded-lg hover:bg-indigo-100 transition-colors">
                <span>رؤية الكل</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7 7-7" />
                </svg>
            </a>
            </div>
            <div class="relative">
            <div id="gradient-left" class="absolute top-0 right-0 h-full w-24 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none transition-opacity duration-300 opacity-0"></div>
            <div id="gradient-right" class="absolute top-0 left-0 h-full w-24 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none transition-opacity duration-300"></div>
            <div id="agents-slider" class="flex overflow-x-auto gap-5 no-scrollbar px-4 sm:pl-6 lg:pl-8">
                <!-- Agent Card -->
                <div class="bg-[rgba(247,249,250,1)] p-5 rounded-2xl flex flex-col gap-2 min-w-[380px]">
                    <div class="self-end">
                        <span class="bg-[#e6f6f0] text-[#1d8e5a] text-[11px] font-medium px-2 py-1 rounded-md">مسوق عقاري</span>
                    </div>
                    <div class="flex items-center gap-1 text-[rgba(48,62,124,1)]">
                        <img src="{{ asset('images/agent.png') }}" alt="سامح الزهيري عامر" class="w-16 h-16 rounded-full object-cover border-2 border-white">
                        <div class="space-y-1">
                            <div class="flex items-center gap-0.5 text-slate-500 text-[9px]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-[rgba(217,222,242,1)]" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 20l-4.95-6.05a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                                <span>الرياض</span>
                            </div>
                            <h3 class="font-medium text-lg text-[rgba(48,62,124,1)]">سامح الزهيري عامر</h3>
                        </div>
                    </div>
                    <div class="flex justify-between items-center gap-[60px] pt-2">
                        <div class="flex items-center gap-1.5 text-[rgba(48,62,124,1)] text-[8px] font-medium">
                            <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.75391 8.60121H3.31641V5.44201L1.75391 4.74756V8.60121ZM2.63281 5.76918H3.02344V6.35512H2.63281V5.76918ZM2.63281 6.55043H3.02344V7.13637H2.63281V6.55043ZM2.63281 7.33168H3.02344V7.91762H2.63281V7.33168ZM2.04688 5.76918H2.4375V6.35512H2.04688V5.76918ZM2.04688 6.55043H2.4375V7.13637H2.04688V6.55043ZM2.04688 7.33168H2.4375V7.91762H2.04688V7.33168Z" fill="#303E7C"/><path d="M-0.00390625 8.60121H1.55859V4.74756L-0.00390625 5.44201V8.60121ZM0.875 5.76918H1.26562V6.35512H0.875V5.76918ZM0.875 6.55043H1.26562V7.13637H0.875V6.55043ZM0.875 7.33168H1.26562V7.91762H0.875V7.33168ZM0.289062 5.76918H0.679688V6.35512H0.289062V5.76918ZM0.289062 6.55043H0.679688V7.13637H0.289062V6.55043ZM0.289062 7.33168H0.679688V7.91762H0.289062V7.33168Z" fill="#303E7C"/><path d="M2.33976 4.79273C2.33976 4.79326 2.3396 4.79377 2.3396 4.7943L3.45364 5.28943C3.48892 5.30512 3.51163 5.3401 3.51163 5.37867V8.60133H5.07413V0.436035L2.33976 1.3475V4.79273ZM3.99991 1.47242L4.78116 1.27711V1.66773L3.99991 1.86305V1.47242ZM3.99991 2.05836L4.78116 1.86305V2.25367L3.99991 2.44898V2.05836ZM3.99991 2.6443L4.78116 2.44898V2.83961L3.99991 3.03492V2.6443ZM3.99991 3.23023L4.78116 3.03492V3.42555L3.99991 3.62086V3.23023ZM3.99991 3.81617L4.78116 3.62086V4.01148L3.99991 4.2068V3.81617ZM3.99991 4.40211L4.78116 4.2068V4.59742L3.99991 4.79273V4.40211ZM3.99991 4.98805L4.78116 4.79273V5.18336L3.99991 5.37867V4.98805ZM3.99991 5.57398L4.78116 5.37867V5.7693L3.99991 5.96461V5.57398ZM2.82804 1.86305L3.60929 1.66773V2.05836L2.82804 2.25367V1.86305ZM2.82804 2.44898L3.60929 2.25367V2.6443L2.82804 2.83961V2.44898ZM2.82804 3.03492L3.60929 2.83961V3.23023L2.82804 3.42555V3.03492ZM2.82804 3.62086L3.60929 3.42555V3.81617L2.82804 4.01148V3.62086Z" fill="#303E7C"/><path d="M5.26953 0.436035V8.60133H8.00391V1.3475L5.26953 0.436035ZM6.34375 5.96461L5.5625 5.7693V5.37867L6.34375 5.57398V5.96461ZM6.34375 5.37867L5.5625 5.18336V4.79273L6.34375 4.98805V5.37867ZM6.34375 4.79273L5.5625 4.59742V4.2068L6.34375 4.40211V4.79273ZM6.34375 4.2068L5.5625 4.01148V3.62086L6.34375 3.81617V4.2068ZM6.34375 3.62086L5.5625 3.42555V3.03492L6.34375 3.23023V3.62086ZM6.34375 3.03492L5.5625 2.83961V2.44898L6.34375 2.6443V3.03492ZM6.34375 2.44898L5.5625 2.25367V1.86305L6.34375 2.05836V2.44898ZM6.34375 1.86305L5.5625 1.66773V1.27711L6.34375 1.47242V1.86305ZM7.51562 6.35523L6.73438 6.15992V5.7693L7.51562 5.96461V6.35523ZM7.51562 5.7693L6.73438 5.57398V5.18336L7.51562 5.37867V5.7693ZM7.51562 5.18336L6.73438 4.98805V4.59742L7.51562 4.79273V5.18336ZM7.51562 4.59742L6.73438 4.40211V4.01148L7.51562 4.2068V4.59742ZM7.51562 4.01148L6.73438 3.81617V3.42555L7.51562 3.62086V4.01148ZM7.51562 3.42555L6.73438 3.23023V2.83961L7.51562 3.03492V3.42555ZM7.51562 2.83961L6.73438 2.6443V2.25367L7.51562 2.44898V2.83961ZM7.51562 2.25367L6.73438 2.05836V1.66773L7.51562 1.86305V2.25367Z" fill="#303E7C"/></svg>                  
                            <span>+25 عقار</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <a href="#" class="h-[27px] px-3 flex items-center gap-2 rounded-lg bg-[rgba(48,63,125,1)] text-white hover:bg-indigo-800 transition-colors text-xs font-normal"><svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_457_2790)"><path d="M10.0648 7.70328C10.0471 7.68858 8.04344 6.26303 7.50243 6.35024C7.24144 6.39636 7.09241 6.57447 6.79333 6.93069C6.74521 6.98817 6.62925 7.12551 6.53969 7.22342C6.35067 7.16184 6.16629 7.08679 5.98799 6.99886C5.06753 6.55075 4.32384 5.80705 3.87572 4.8866C3.78779 4.70829 3.71275 4.52392 3.65117 4.33489C3.74941 4.245 3.88709 4.12904 3.9459 4.07959C4.30045 3.78218 4.47823 3.63281 4.52434 3.37149C4.61891 2.83048 3.18601 0.827486 3.1713 0.809441C3.10605 0.716895 3.02106 0.639993 2.92247 0.584285C2.82389 0.528577 2.71416 0.495453 2.60122 0.487305C2.02044 0.487305 0.362305 2.638 0.362305 3.00057C0.362305 3.02162 0.392714 5.16162 3.03162 7.84597C5.71297 10.4819 7.85297 10.5123 7.87402 10.5123C8.23626 10.5123 10.3873 8.85415 10.3873 8.27337C10.379 8.16041 10.3459 8.05068 10.2901 7.9521C10.2343 7.85352 10.1574 7.76854 10.0648 7.70328ZM7.83693 9.84194C7.54687 9.81722 5.74906 9.58029 3.50346 7.37446C1.28694 5.11784 1.05603 3.31702 1.03298 3.03799C1.47099 2.35049 1.99998 1.7254 2.60556 1.1797C2.61893 1.19306 2.63664 1.21311 2.65936 1.23918C3.12379 1.87317 3.52387 2.55187 3.85367 3.26523C3.74642 3.37312 3.63306 3.47476 3.51416 3.56965C3.32976 3.71015 3.16044 3.8694 3.0089 4.04483C2.98326 4.08081 2.965 4.12152 2.9552 4.16459C2.94539 4.20767 2.94422 4.25226 2.95176 4.29579C3.02248 4.60213 3.13079 4.89856 3.27423 5.17833C3.78814 6.23363 4.64089 7.08626 5.69626 7.60003C5.97597 7.74367 6.27241 7.8521 6.57879 7.92283C6.62232 7.93054 6.66695 7.92945 6.71005 7.91964C6.75315 7.90982 6.79385 7.89148 6.82975 7.86569C7.00581 7.71353 7.16561 7.54354 7.30661 7.35842C7.41153 7.23345 7.55155 7.0667 7.60468 7.01958C8.31985 7.34906 9.00007 7.74962 9.63507 8.21522C9.66281 8.23862 9.68252 8.25666 9.69556 8.26836C9.14983 8.87413 8.52461 9.40324 7.83693 9.84128V9.84194Z" fill="white"/><path d="M7.71398 5.166H8.38231C8.38152 4.45724 8.09961 3.77773 7.59843 3.27655C7.09726 2.77538 6.41775 2.49347 5.70898 2.49268V3.16101C6.24058 3.16154 6.75025 3.37295 7.12614 3.74884C7.50204 4.12474 7.71345 4.63441 7.71398 5.166Z" fill="white"/><path d="M9.38481 5.16593H10.0531C10.0518 4.0142 9.5937 2.91002 8.7793 2.09562C7.9649 1.28122 6.86072 0.823104 5.70898 0.821777V1.49011C6.68352 1.49126 7.61781 1.8789 8.30691 2.568C8.99602 3.2571 9.38366 4.1914 9.38481 5.16593Z" fill="white"/></g><defs><clipPath id="clip0_457_2790"><rect width="10.6933" height="10.6933" fill="white" transform="translate(0.0283203 0.15332)"/></clipPath></defs></svg><span>اتصل بنا</span></a>
                            <a href="#" class="h-[27px] px-3 flex items-center gap-2 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-200/50 transition-colors text-xs font-normal"><svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.33278 0.858896C8.85446 0.819819 8.25939 0.819824 7.50035 0.819824H5.24978C4.49073 0.819824 3.89564 0.819819 3.41735 0.858896C2.93032 0.898688 2.52798 0.98106 2.16379 1.16662C1.5651 1.47166 1.07835 1.95841 0.773305 2.5571C0.58775 2.92129 0.505378 3.32363 0.465586 3.81066C0.426508 4.28895 0.426514 4.88405 0.426514 5.64309V8.0014C0.426514 9.38329 1.54673 10.5035 2.92859 10.5035H3.26157C3.39907 10.5035 3.4931 10.6424 3.44203 10.77C3.06207 11.72 4.15605 12.5787 4.98858 11.9841L6.43321 10.9522L6.46044 10.9328C6.85271 10.6564 7.32013 10.5066 7.79999 10.5036L7.83336 10.5035H8.21833C9.07525 10.5036 9.598 10.5037 10.0371 10.375C11.0769 10.0701 11.8902 9.25685 12.1951 8.21699C12.3238 7.7779 12.3237 7.25521 12.3236 6.39828V5.64308C12.3236 4.88405 12.3236 4.28894 12.2845 3.81066C12.2447 3.32363 12.1623 2.92129 11.9768 2.5571C11.6717 1.95841 11.185 1.47166 10.5863 1.16662C10.2221 0.98106 9.81979 0.898688 9.33278 0.858896ZM2.54062 1.90618C2.76829 1.79018 3.04924 1.72177 3.48494 1.68617C3.92548 1.65017 4.48673 1.64985 5.26835 1.64985H7.48176C8.26337 1.64985 8.82464 1.65017 9.26516 1.68617C9.70087 1.72177 9.98181 1.79018 10.2095 1.90618C10.652 2.13165 11.0118 2.49142 11.2373 2.93393C11.3532 3.1616 11.4216 3.44255 11.4573 3.87825C11.4932 4.3188 11.4936 4.88004 11.4936 5.66166V6.31694C11.4936 7.28083 11.4894 7.67382 11.3986 7.98342C11.1732 8.75203 10.5721 9.35308 9.80352 9.57846C9.49392 9.66926 9.10093 9.67347 8.13704 9.67347H7.83336L7.79468 9.67352C7.14543 9.67767 6.51301 9.88037 5.98229 10.2543L4.50613 11.3087C4.34817 11.4215 4.1406 11.2585 4.2127 11.0783C4.48185 10.4054 3.98629 9.67347 3.26157 9.67347H2.92859C2.00514 9.67347 1.25654 8.92489 1.25654 8.0014V5.66166C1.25654 4.88004 1.25686 4.3188 1.29286 3.87825C1.32846 3.44255 1.39687 3.1616 1.51287 2.93393C1.73834 2.49142 2.09811 2.13165 2.54062 1.90618Z" fill="#303E7C"/><path d="M4.71535 5.66126C4.71535 5.96688 4.4676 6.21462 4.162 6.21462C3.85639 6.21462 3.60864 5.96688 3.60864 5.66126C3.60864 5.35566 3.85639 5.10791 4.162 5.10791C4.4676 5.10791 4.71535 5.35566 4.71535 5.66126Z" fill="#303E7C"/><path d="M6.92824 5.66126C6.92824 5.96688 6.6805 6.21462 6.37489 6.21462C6.06927 6.21462 5.82153 5.96688 5.82153 5.66126C5.82153 5.35566 6.06927 5.10791 6.37489 5.10791C6.6805 5.10791 6.92824 5.35566 6.92824 5.66126Z" fill="#303E7C"/><path d="M9.14137 5.66126C9.14137 5.96688 8.89364 6.21462 8.58802 6.21462C8.2824 6.21462 8.03467 5.96688 8.03467 5.66126C8.03467 5.35566 8.2824 5.10791 8.58802 5.10791C8.89364 5.10791 9.14137 5.35566 9.14137 5.66126Z" fill="#303E7C"/></svg><span>تواصل معنا</span></a>
                            <a href="#" title="WhatsApp" class="flex items-center justify-center w-[34px] h-[27px] rounded-lg bg-[#25D366] text-white hover:bg-[#1EAE54] transition-colors"><svg width="13.5" height="13.5" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.00001 0.78125C3.28935 0.78125 0.281261 3.78934 0.281261 7.5C0.281261 8.42556 0.468681 9.30855 0.808083 10.1122C0.897118 10.323 0.95714 10.4654 0.99723 10.5749C1.03812 10.6865 1.04386 10.7269 1.04458 10.7373C1.04865 10.796 1.03379 10.8758 0.93245 11.2546L0.297189 13.6288C0.253919 13.7906 0.300179 13.9631 0.418554 14.0815C0.53693 14.1998 0.70945 14.2461 0.87117 14.2028L3.2454 13.5676C3.62417 13.4662 3.70397 13.4514 3.76266 13.4554C3.77307 13.4561 3.81346 13.4619 3.92512 13.5028C4.03459 13.5429 4.17704 13.6029 4.38785 13.6919C5.19146 14.0313 6.07445 14.2188 7.00001 14.2188C10.7107 14.2188 13.7188 11.2107 13.7188 7.5C13.7188 3.78934 10.7107 0.78125 7.00001 0.78125ZM5.10806 3.90626L5.05015 3.9062C4.75036 3.90569 4.47381 3.90523 4.20182 4.02946C4.00422 4.11972 3.83609 4.27307 3.71366 4.42622C3.59123 4.57938 3.47869 4.77716 3.43417 4.98979C3.37314 5.28125 3.42347 5.50302 3.4773 5.74026L3.48474 5.77307C3.75631 6.97575 4.3912 8.15504 5.36796 9.13179C6.34471 10.1086 7.524 10.7434 8.72668 11.015L8.75949 11.0224C8.99673 11.0763 9.2185 11.1266 9.50996 11.0656C9.72259 11.0211 9.92037 10.9085 10.0735 10.7861C10.2267 10.6637 10.38 10.4955 10.4703 10.2979C10.5945 10.0259 10.5941 9.74939 10.5935 9.4496L10.5935 9.39169C10.5935 9.25395 10.5892 9.022 10.4999 8.80762C10.3932 8.55151 10.1733 8.34043 9.82865 8.28642L9.82507 8.28586C9.39799 8.21893 9.07315 8.16802 8.84352 8.13464C8.72858 8.11793 8.63318 8.10497 8.55855 8.09649C8.4972 8.08953 8.41279 8.08077 8.34219 8.0849C8.03621 8.10281 7.79286 8.22692 7.60437 8.35609C7.48441 8.4383 7.35406 8.54839 7.25156 8.63496C7.2113 8.66897 7.17534 8.69934 7.14599 8.72297L7.09762 8.76191C6.9131 8.91048 6.82083 8.98477 6.70706 8.98243C6.59329 8.98009 6.50982 8.90703 6.34289 8.76091C6.23669 8.66795 6.13259 8.5706 6.03087 8.46888C5.92915 8.36716 5.8318 8.26306 5.73884 8.15686C5.59272 7.98993 5.51966 7.90646 5.51732 7.79269C5.51498 7.67892 5.58926 7.58665 5.73784 7.40213L5.77678 7.35376C5.80041 7.32441 5.83079 7.28845 5.86479 7.24819C5.95136 7.14569 6.06146 7.01534 6.14366 6.89538C6.27283 6.70689 6.39694 6.46354 6.41485 6.15756C6.41898 6.08696 6.41022 6.00255 6.40325 5.9412C6.39478 5.86657 6.38182 5.77117 6.36511 5.65623C6.33173 5.42655 6.28084 5.10188 6.21389 4.67466L6.21333 4.6711C6.15932 4.32645 5.94824 4.10658 5.69213 3.99985C5.47775 3.91052 5.2458 3.90626 5.10806 3.90626Z" fill="white"/></svg></a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>


    <!-- world section -->
    <section class="my-16 flex justify-center px-4">
        <div class="w-full lg:w-[1120px] text-center p-6 md:p-8 lg:p-12 rounded-2xl bg-cover bg-center" style="background-image: url('{{ asset('images/world.png') }}'); background-color: rgba(68, 112, 174, 1);">
            
            <h2 class="text-white text-2xl md:text-3xl lg:text-4xl font-bold mb-6">
                لديك عقار للبيع أو الإيجار؟ ابدأ إعلانك هنا!
            </h2>
            
            <p class="text-white/90 text-base lg:text-lg mb-8 max-w-3xl mx-auto font-medium leading-relaxed">
                يمكنك الآن إصدار رخصة إعلان لعقارك والوصول إلى آلاف المشترين أو المستأجرين المحتملين بكل سهولة. لديك حتى 3 إعلان متاح كحد أقصى لحسابك.
            </p>
            
            <a href="#" class="inline-block bg-[#2C3F80] text-white font-semibold py-3 px-10 rounded-full hover:bg-opacity-90 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[#4A6C9B] focus:ring-white">
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

        buttons.forEach(clickedButton => {
            clickedButton.addEventListener('click', () => {
                buttons.forEach(button => {
                    button.classList.remove('active', ...activeClasses);
                    button.classList.add(...inactiveClasses);
                });
                clickedButton.classList.add('active', ...activeClasses);
                clickedButton.classList.remove(...inactiveClasses);
            });
        });
        
        setInitialState();

        // Property Slider Functionality
        const sliderTrack = document.getElementById('sliderTrack');
        if (sliderTrack) {
            const nextBtn = document.getElementById('nextBtn');
            const prevBtn = document.getElementById('prevBtn');
            const cards = sliderTrack.querySelectorAll('.slider-card');
            
            let currentIndex = 0;
            const cardWidth = 320;
            const gap = 16;
            const slideDistance = cardWidth + gap;
            const maxIndex = cards.length > 0 ? cards.length - 1 : 0;
            
            function updateSliderPosition() {
                const translateX = currentIndex * slideDistance * -1; // Use negative for RTL
                sliderTrack.style.transform = `translateX(${translateX}px)`;
                
                if (prevBtn && nextBtn) {
                    prevBtn.style.opacity = currentIndex === 0 ? '0.5' : '1';
                    nextBtn.style.opacity = currentIndex === maxIndex ? '0.5' : '1';
                    prevBtn.disabled = currentIndex === 0;
                    nextBtn.disabled = currentIndex === maxIndex;
                }
            }
            
            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    if (currentIndex < maxIndex) {
                        currentIndex++;
                        updateSliderPosition();
                    }
                });
            }
            
            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    if (currentIndex > 0) {
                        currentIndex--;
                        updateSliderPosition();
                    }
                });
            }
            
            updateSliderPosition();
        }

        // Agents Slider Functionality
        const agentsSlider = document.querySelector('#agents-slider');
        if (agentsSlider) {
            const gradientLeft = document.querySelector('#gradient-left');
            const gradientRight = document.querySelector('#gradient-right');
            
            const checkGradients = () => {
                const scrollPos = Math.abs(agentsSlider.scrollLeft);
                const maxScroll = agentsSlider.scrollWidth - agentsSlider.clientWidth;

                if (gradientLeft) {
                    gradientLeft.classList.toggle('opacity-0', scrollPos < 10);
                }
                if (gradientRight) {
                    gradientRight.classList.toggle('opacity-0', scrollPos >= maxScroll - 10);
                }
            };

            let isDown = false, startX, scrollLeft;
            agentsSlider.addEventListener('mousedown', (e) => {
                isDown = true;
                agentsSlider.classList.add('active');
                startX = e.pageX - agentsSlider.offsetLeft;
                scrollLeft = agentsSlider.scrollLeft;
            });
            agentsSlider.addEventListener('mouseleave', () => { isDown = false; agentsSlider.classList.remove('active'); });
            agentsSlider.addEventListener('mouseup', () => { isDown = false; agentsSlider.classList.remove('active'); });
            agentsSlider.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - agentsSlider.offsetLeft;
                agentsSlider.scrollLeft = scrollLeft - (x - startX) * 2;
            });
            
            agentsSlider.addEventListener('scroll', checkGradients);
            window.addEventListener('resize', checkGradients);
            checkGradients();
        }

        // Login Modal Logic
        const openModalButton = document.getElementById('open-login-modal');
        const closeModalButton = document.getElementById('close-login-modal');
        const loginModal = document.getElementById('login-modal');

        if(openModalButton && loginModal) {
            openModalButton.addEventListener('click', () => loginModal.classList.remove('hidden'));
        }

        if(closeModalButton && loginModal) {
            closeModalButton.addEventListener('click', () => loginModal.classList.add('hidden'));
        }

        if(loginModal) {
            loginModal.addEventListener('click', (event) => {
                if (event.target === loginModal) {
                    loginModal.classList.add('hidden');
                }
            });
        }
    });
</script>
@endpush