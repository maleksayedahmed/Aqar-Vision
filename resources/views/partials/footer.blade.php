{{-- resources/views/partials/footer.blade.php --}}
<footer class="bg-[#364371] text-white" dir="rtl">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row lg:justify-between gap-16 lg:gap-8 text-center lg:text-right">
            <!-- Column 1: Logo & Description -->
            <div class="flex flex-col items-center lg:items-start lg:w-[275px]">
                <img src="{{ asset('images/logo_light.png') }}" alt="Aqarvision Logo" class="h-16 mb-4">
                <p class="text-white/80 leading-relaxed font-medium">
                    عقار فيجن - منصتك الموثوقة لاستكشاف وامتلاك العقارات في جميع أنحاء المملكة.
                </p>
                <!-- Social links here -->
            </div>
            <!-- Column 2: Quick Links -->
            <div class="flex flex-col items-center lg:items-start">
                <h3 class="text-xl font-bold mb-6">وصلات سريعة</h3>
                <div class="flex flex-col gap-3">
                    <a href="#" class="text-white/80 hover:text-white">البحث</a>
                    <a href="#" class="text-white/80 hover:text-white">احدث العقارات</a>
                </div>
            </div>
            <!-- Column 3: Contact Us -->
            <div class="flex flex-col items-center lg:items-start">
                <h3 class="text-xl font-bold mb-6">تواصل معنا</h3>
                <div class="flex flex-col gap-4 w-full max-w-xs mx-auto lg:mx-0">
                    <a href="tel:0509777" class="w-[260px] bg-[rgba(26,36,76,1)] p-4 rounded-xl flex items-center justify-between flex-row-reverse">
                       {{-- Phone SVG and details --}}
                       <div class="text-right">
                            <p class="text-xs text-white/70">اتصل بنا الآن</p>
                            <p class="font-semibold">0509777</p>
                        </div>
                    </a>
                    <a href="mailto:aqarvition@gmail.com" class="w-[260px] bg-[rgba(26,36,76,1)] p-4 rounded-xl flex items-center justify-between flex-row-reverse">
                        {{-- Email SVG and details --}}
                        <div class="text-right">
                            <p class="text-xs text-white/70">تواصل معنا</p>
                            <p class="font-semibold">aqarvition@gmail.com</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="border-t border-white/10 pt-8 mt-12 text-center">
            <p class="text-white/60 text-sm">حقوق النشر © 2025 جميع الحقوق محفوظة</p>
        </div>
    </div>
</footer>