{{-- resources/views/agent/home.blade.php --}}

@extends('layouts.agent')

@section('title', 'الباقات')

@section('content')

<!-- Responsive Pricing Section -->
<section class="pb-10"> 
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12"> 
        <div class="text-center">
            <!-- Heading -->
            <h2 class="text-2xl md:text-[32px] font-medium text-[rgba(48,62,124,1)] mb-4">
                اختر الباقة المناسبة لك
            </h2>
            <!-- Description -->
            <p class="max-w-3xl mx-auto text-[rgba(77,77,77,1)] leading-relaxed">
                استفد من أفضل الميزات لعرض عقاراتك بفعالية والوصول لأكبر عدد من المهتمين. اختر الباقة التي<br class="hidden md:block"> تلبي احتياجاتك، أو قم بتخصيص باقتك الخاصة.
            </p>
            
            <!-- Billing Cycle Toggle Switch -->
            <div class="mt-8 flex justify-center">
                <div class="inline-flex bg-gray-100 p-1.5 rounded-full">
                    <button id="yearly-btn" class="px-6 sm:px-10 py-2.5 text-base md:text-[17.28px] font-bold text-white bg-[rgba(48,62,124,1)] rounded-full shadow-sm transition-colors duration-300 ease-in-out focus:outline-none">
                        سنوي
                    </button>
                    <button id="monthly-btn" class="px-6 sm:px-10 py-2.5 text-base md:text-[17.28px] font-medium text-[rgba(26,26,26,1)] rounded-full transition-colors duration-300 ease-in-out focus:outline-none">
                        شهري
                    </button>
                </div>
            </div>
        </div>

        <!-- Pricing Cards Grid -->
        <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Card 1: Basic -->
            <div class="price-card bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8 flex flex-col">
                <div class="text-center">
                    <h3 class="text-xl md:text-[23.3px] font-medium text-[rgba(3,33,110,1)]">الباقة الاساسية</h3>
                    <p class="text-3xl md:text-[31.3px] my-4 font-medium text-[rgba(26,26,26,1)] flex justify-center items-end gap-[9.3px]">
                       <span class="price-value" data-monthly="150" data-yearly="1500">1500</span>
                       <span class="billing-cycle text-base md:text-[16.6px] text-[rgba(26,26,26,1)] flex items-center"><img src="images/royal.png" class="inline h-4 mr-1" alt="Currency">/سنة</span>
                    </p>
                    <p class="text-[rgba(153,153,153,1)] text-[15.5px] min-h-[3rem]">مثالية للمعلنين الجدد أو الذين لديهم عدد قليل من العقارات</p>
                </div>
                <ul class="mt-8 space-y-4 text-sm font-medium text-gray-700 flex-grow">
                    <!-- features list -->
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg><span>عرض 5 عقارات</span></li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg><span>دعم فني</span></li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg><span>صور وفيديوهات عالية الجودة</span></li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg><span>إحصائيات مشاهدات الإعلان</span></li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg><span>إدارة الحملات الإعلانية واستهداف العملاء بدقة</span></li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg><span>تحليل الأداء شهريًا لضمان أفضل النتائج</span></li>
                </ul>
                <a href="#" class="w-full mt-8 bg-[rgba(48,62,124,1)] text-white text-lg md:text-[21.3px] font-medium py-3 text-center rounded-lg hover:bg-opacity-90 transition-colors">اشترك الآن</a>
            </div>

            <!-- Card 2: Most Popular -->
            <div class="price-card bg-white rounded-xl shadow-lg border-2 border-[rgba(27,177,105,1)] p-6 md:p-8 flex flex-col relative">
                <span class="absolute -top-4 right-1/2 transform translate-x-1/2 bg-[rgba(27,177,105,1)] text-white text-xs font-bold px-4 py-1.5 rounded-full">الأكثر شيوعا</span>
                 <div class="text-center">
                    <h3 class="text-xl md:text-[23.3px] font-medium text-[rgba(27,177,105,1)]">الباقة الاساسية</h3>
                    <p class="text-3xl md:text-[31.3px] my-4 font-medium text-[rgba(26,26,26,1)] flex justify-center items-end gap-[9.3px]">
                       <span class="price-value" data-monthly="300" data-yearly="3000">3000</span>
                       <span class="billing-cycle text-base md:text-[16.6px] text-[rgba(26,26,26,1)] flex items-center">ريال/سنة</span>
                    </p>
                    <p class="text-[rgba(153,153,153,1)] text-[15.5px] min-h-[3rem]">مثالية للمعلنين الجدد أو الذين لديهم عدد قليل من العقارات</p>
                </div>
                <ul class="mt-8 space-y-4 text-sm font-medium text-gray-700 flex-grow">
                    <!-- features list -->
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg><span>عرض 20 عقارات</span></li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg><span>دعم فني ذو أولوية</span></li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg><span>صور وفيديوهات عالية الجودة</span></li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg><span>إحصائيات مشاهدات الإعلان</span></li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg><span>إدارة الحملات الإعلانية واستهداف العملاء بدقة</span></li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg><span>تحليل الأداء شهريًا لضمان أفضل النتائج</span></li>
                </ul>
                <a href="#" class="w-full mt-8 bg-[rgba(27,177,105,1)] text-white text-lg md:text-[21.3px] font-medium py-3 text-center rounded-lg hover:bg-opacity-90 transition-colors">اشترك الآن</a>
            </div>

            <!-- Card 3: Companies -->
            <div class="price-card bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8 flex flex-col">
                <div class="text-center">
                    <h3 class="text-xl md:text-[23.3px] font-medium text-[rgba(3,33,110,1)]">الباقة الشركات</h3>
                     <p class="text-3xl md:text-[31.3px] my-4 font-medium text-[rgba(26,26,26,1)] flex justify-center items-end gap-[9.3px]">
                       <span class="price-value" data-monthly="500" data-yearly="5000">5000</span>
                       <span class="billing-cycle text-base md:text-[16.6px] text-[rgba(26,26,26,1)] flex items-center">ريال/سنة</span>
                    </p>
                    <p class="text-[rgba(153,153,153,1)] text-[15.5px] min-h-[3rem]">مثالية للمعلنين الجدد أو الذين لديهم عدد قليل من العقارات</p>
                </div>
                <ul class="mt-8 space-y-4 text-sm font-medium text-gray-700 flex-grow">
                    <!-- features list -->
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg><span>عرض 50 عقارات</span></li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg><span>دعم فني 24/7</span></li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg><span>ترويج إعلانات مميزة (5 شهريا)</span></li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg><span>وصول لجميع الاحصائيات</span></li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg><span>حساب مدير متعدد المستخدمين</span></li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg><span>تحليل الأداء شهريًا لضمان أفضل النتائج</span></li>
                </ul>
                <a href="#" class="w-full mt-8 bg-[rgba(48,62,124,1)] text-white text-lg md:text-[21.3px] font-medium py-3 text-center rounded-lg hover:bg-opacity-90 transition-colors">اشترك الآن</a>
            </div>

        </div>
    </div>
</section>


       <!-- CTA Section -->
    <section class="w-full px-4 sm:px-6 lg:px-4 py-10">
        <div class=" ">
            <div class="bg-[url('{{asset('images/adsbanner.png')}}')] lg:h-[294px] bg-cover bg-center rounded-2xl shadow-sm overflow-hidden relative p-8 lg:p-10">
                <!-- Background Pattern -->
                <div class="absolute inset-0 bg-cover bg-center opacity-20" style="background-image: url('{{asset('images/bg-pattern.png')}}');"></div>

                <!-- Content -->
                <div class="relative z-10 flex flex-col items-center text-center">
                    <!-- Logo -->
                    <img src="{{asset('images/logo.png')}}" class="w-[45px] h-[35px] mb-4" alt="logo">

                    <!-- Heading -->
                    <h2 class="text-[19px] font-bold text-[rgba(26,26,26,1)] mb-2">
                        باقات مخصصة تناسب احتياجاتك؟
                    </h2>

                    <!-- Description -->
                    <p class="max-w-3xl text-[19px] mx-auto text-[rgba(102,102,102,1)] font-medium leading-relaxed mb-4">
                        إذا كانت باقاتنا الحالية لا تلبي متطلباتك بالضبط، يمكننا تصميم باقة اشتراك مخصصة لك بالكامل
                    </p>

                    <!-- Action Button -->
                    <a href="#" class="bg-[rgba(48,62,124,1)] text-white font-bold py-3 px-12 rounded-lg hover:bg-opacity-90 transition-colors shadow-md">
                       تواصل معنا
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- packages toggle -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
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
                    billingCycleEl.innerHTML = '<img src="{{asset('images/royal.png')}}" class="h-[29px]" width="26.5">/سنة';
                } else {
                    priceValueEl.textContent = monthlyPrice;
                    billingCycleEl.innerHTML = '<img src="{{asset('images/royal.png')}}" class="h-[29px]" width="26.5">/شهر';
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
        const initialBillingType = yearlyBtn.classList.contains('bg-[rgba(48,62,124,1)]') ? 'yearly' : 'monthly';
        updatePrices(initialBillingType);
    });
</script>
@endsection
