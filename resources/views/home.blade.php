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
    <section class="bg-white flex flex-col items-center p-6 rounded-[20px] shadow-sm md:shadow-none mt-[-140px] md:mt-[-100px] w-[80%] lg:w-[878px] h-auto lg:h-auto gap-6 lg:gap-[40px]">
        
        <div class="inline-flex p-1 bg-white border border-gray-200 rounded-xl">
            <button data-tab="buy" class="toggle-btn px-8 py-2 text-sm font-semibold rounded-lg focus:outline-none transition-colors">
                شراء
            </button>
            <button data-tab="rent" class="toggle-btn active px-8 py-2 text-sm font-semibold rounded-lg focus:outline-none transition-colors">
                إيجار
            </button>
        </div>

        {{-- Main Search Form --}}
        <form action="#" method="GET" class="w-full">
            <div class="flex flex-col-reverse lg:flex-row-reverse items-center gap-4 w-full">
                
                <button type="submit" class="flex items-center justify-center w-full lg:w-auto h-12 bg-[rgba(48,62,124,1)] text-white font-semibold rounded-lg px-10 hover:bg-indigo-800 focus:outline-none flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span>بحث</span>
                </button>

                <!-- District Dropdown -->
                <div class="w-full h-12">
                    <select name="district_id" id="district-select" class="w-full h-full bg-white border border-gray-200 rounded-lg px-4 cursor-pointer hover:border-indigo-400 transition-colors text-sm font-medium text-gray-700 disabled:bg-gray-100" disabled>
                        <option value="">اختر المدينة أولاً</option>
                    </select>
                </div>
                
                <!-- City Dropdown -->
                <div class="w-full h-12">
                    <select name="city_id" id="city-select" class="w-full h-full bg-white border border-gray-200 rounded-lg px-4 cursor-pointer hover:border-indigo-400 transition-colors text-sm font-medium text-gray-700">
                        <option value="">اختر المدينة</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Property Type Dropdown -->
                <div class="w-full h-12">
                    <select name="property_type_id" class="w-full h-full bg-white border border-gray-200 rounded-lg px-4 cursor-pointer hover:border-indigo-400 transition-colors text-sm font-medium text-gray-700">
                        <option value="">نوع العقار</option>
                        <option value="1">شقة</option>
                        <option value="2">فيلا</option>
                    </select>
                </div>
            </div>
        </form>
    </section>

    <section class="max-w-[1325px] w-full mx-auto py-8 px-4 lg:px-0">
        <!-- The Hero Slider Component -->
        <div x-data="{ activeSlide: 0, slides: [ { headline: 'شفنا لك البيت، وبسعر السوق - كل شيء واضح', subheadline: 'مع عقار فيجن' }, { headline: 'تحليلات دقيقة وتقارير مفصلة لكل عقار', subheadline: 'لاتخاذ أفضل قرار' }, { headline: 'ابحث، قارن، واشترِ بثقة تامة', subheadline: 'مستقبلك يبدأ هنا' } ] }" x-init="setInterval(() => { activeSlide = (activeSlide + 1) % slides.length }, 5000)" class="relative rounded-2xl overflow-hidden bg-[rgba(236,238,249,1)] w-full">
            <div class="absolute bottom-0 left-0 opacity-40">
                <svg width="400" height="400" xmlns="http://www.w3.org/2000/svg">
                    <defs><pattern id="pattern-squares" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><rect x="8" y="8" width="4" height="4" fill="#e0e7ff" /></pattern></defs>
                    <rect x="0" y="0" width="100%" height="100%" fill="url(#pattern-squares)" />
                </svg>
            </div>
            <div class="relative grid grid-cols-1 lg:grid-cols-2 items-center gap-0 lg:gap-8 py-6 px-4 md:py-[60px] md:px-[65px] z-10">
                <div class="flex flex-col items-center lg:items-start gap-y-8 text-center lg:text-right">
                    <img src="{{ asset('images/logo.png') }}" class="w-[70px] h-[60px]" alt="logo">
                    <div class="relative min-h-[120px] md:min-h-[140px] w-full">
                        <template x-for="(slide, index) in slides" :key="index">
                            <div x-show="activeSlide === index" x-transition:enter="transition ease-out duration-500 enter-start-opacity-0 transform -translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-300 leave-start-opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform translate-y-4" class="absolute w-full space-y-2">
                                <h1 class="text-2xl md:text-3xl font-bold text-slate-800" x-text="slide.headline"></h1>
                                <p class="text-2xl md:text-3xl font-bold"><span class="text-slate-700">مع</span> <span class="text-indigo-600" x-text="slide.subheadline.split(' ')[1]"></span></p>
                            </div>
                        </template>
                    </div>
                    <div class="flex gap-x-2 items-center self-center lg:self-end lg:-ml-[8%]">
                        <template x-for="(slide, index) in slides" :key="index">
                            <button @click="activeSlide = index" class="h-1.5 rounded-full transition-all duration-300" :class="{ 'bg-indigo-600 w-8': activeSlide === index, 'bg-slate-300 w-1.5 hover:bg-slate-400': activeSlide !== index }"></button>
                        </template>
                    </div>
                </div>
                <div class="hidden lg:flex relative justify-center items-center h-full min-h-[250px] lg:min-h-0">
                    <img src="{{ asset('images/home.png') }}" alt="Modern house" class="relative lg:absolute mt-8 lg:mt-[150px] lg:-ml-[210px] w-[400px] sm:w-[300px] lg:w-[380px] h-auto object-contain">
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
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7 7-7" /></svg>
            </a>
        </div>
        <div class="relative">
            <button id="nextBtn" class="absolute cursor-pointer top-1/2 left-0 lg:left-[-50px] z-10 transform -translate-y-1/2 bg-[rgba(236,238,249,1)] border border-gray-200 rounded-full p-2 hover:bg-gray-100"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 rotate-180 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></button>
            <button id="prevBtn" class="absolute cursor-pointer top-1/2 right-0 lg:right-[-35px] z-10 transform -translate-y-1/2 bg-[rgba(236,238,249,1)] border border-gray-200 rounded-full p-2 hover:bg-gray-100"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></button>
            <div class="slider-container px-4">
                <div class="slider-track" id="sliderTrack">
                    {{-- Property Cards would be looped here from your controller --}}
                </div>
            </div>
        </div>
    </section>

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
                    {{-- Agent Cards would be looped here from your controller --}}
                </div>
            </div>
        </div>
    </section>

    <section class="my-16 flex justify-center px-4">
        <div class="w-full lg:w-[1120px] text-center p-6 md:p-8 lg:p-12 rounded-2xl bg-cover bg-center" style="background-image: url('{{ asset('images/world.png') }}'); background-color: rgba(68, 112, 174, 1);">
            <h2 class="text-white text-2xl md:text-3xl lg:text-4xl font-bold mb-6">لديك عقار للبيع أو الإيجار؟ ابدأ إعلانك هنا!</h2>
            <p class="text-white/90 text-base lg:text-lg mb-8 max-w-3xl mx-auto font-medium leading-relaxed">
                يمكنك الآن إصدار رخصة إعلان لعقارك والوصول إلى آلاف المشترين أو المستأجرين المحتملين بكل سهولة. لديك حتى 3 إعلان متاح كحد أقصى لحسابك.
            </p>
            <a href="#" class="inline-block bg-[#2C3F80] text-white font-semibold py-3 px-10 rounded-full hover:bg-opacity-90 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[#4A6C9B] focus:ring-white">إصدار ترخيص اعلان</a>
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
        }

        // Property Slider Functionality
        const sliderTrack = document.getElementById('sliderTrack');
        if (sliderTrack) {
            const nextBtn = document.getElementById('nextBtn');
            const prevBtn = document.getElementById('prevBtn');
            const cards = sliderTrack.querySelectorAll('.slider-card');
            
            if (cards.length > 0) {
                let currentIndex = 0;
                const cardWidth = 320;
                const gap = 16;
                const slideDistance = cardWidth + gap;
                const maxIndex = cards.length - 1;

                function updateSliderPosition() {
                    const translateX = currentIndex * slideDistance * -1;
                    sliderTrack.style.transform = `translateX(${translateX}px)`;
                    
                    if(prevBtn && nextBtn){
                        prevBtn.disabled = currentIndex === 0;
                        nextBtn.disabled = currentIndex >= maxIndex;
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
                window.addEventListener('resize', updateSliderPosition);
            }
        }

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