{{-- ============================================= --}}
{{-- THIS HEADER IS SHOWN ONLY FOR GUESTS --}}
{{-- ============================================= --}}
<header id="main-header" class="py-[5px] bg-[linear-gradient(90deg,_#F6F8FF_0%,_#FFFFFF_100%)] sticky top-0 z-50 transition-transform duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4">
        <div class="flex flex-wrap items-center justify-between min-h-16 py-2">
            <!-- Left side - Logo -->
            
<!-- Logo & Desktop Navigation -->
<div class="flex items-center gap-[50px]">
    <a href="{{ route('home') }}">
        <img src="{{ asset('images/logo.svg') }}" class="w-[70px] h-[60px]" alt="logo">
    </a>
    <div class="hidden lg:flex gap-[26px]">
        <nav class="hidden lg:flex items-center gap-x-6">
            <a href="{{ route('home') }}" class="text-[16px] {{ request()->routeIs('home') ? 'text-[rgba(79,171,232,1)]' : 'text-[#303f7d]' }} font-medium hover:text-[#6381ff]">الرئيسية</a>
            <a href="{{ route('all.agents') }}" class="text-[16px] {{ request()->routeIs('all.agents') ? 'text-[rgba(79,171,232,1)]' : 'text-[#303f7d]' }} font-medium hover:text-[#6381ff]">وسطاء العقاريون</a>
            <a href="{{ route('user.about-us') }}" class="text-[16px] {{ request()->routeIs('user.about-us') ? 'text-[rgba(79,171,232,1)]' : 'text-[#303f7d]' }} font-medium hover:text-[#6381ff]">نبذة عنا</a>
            <a href="{{ route('contact.us') }}" class="text-[16px] {{ request()->routeIs('contact.us') ? 'text-[rgba(79,171,232,1)]' : 'text-[#303f7d]' }} font-medium hover:text-[#6381ff]">تواصل معنا</a>
        </nav>
        <div class="hidden md:flex">
                <button class="flex items-center gap-x-2 text-sm bg-gray-200 hover:bg-gray-300 p-0.5 rounded-lg transition-colors">
                    <div class="flex items-center gap-x-1 text-white">
                        <img src="{{ asset('images/flag.svg') }}" alt="arabic flag">
                    </div>

                    <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
    </div>
</div>
            <!-- Right side - Controls -->
            <div class="flex items-center gap-x-2 lg:gap-x-4">
                <!-- Map Button -->
                <a href="{{ route('properties.map') }}" class="hidden lg:flex bg-[rgba(48,63,125,1)] hover:bg-[rgba(48,63,125,0.9)] text-white px-4 py-2 rounded-lg items-center gap-2 transition-colors duration-200 text-sm font-medium shadow-sm">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2C6.686 2 4 4.686 4 8c0 4.28 6 10 6 10s6-5.72 6-10c0-3.314-2.686-6-6-6zm0 8.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" clip-rule="evenodd"></path></svg>
                    <span>بحث علي الخريطة </span>
                </a>

                <!-- Login Trigger Button -->
                <div class="relative">
                    <button id="open-login-modal" type="button" class="flex items-center gap-x-1 sm:gap-x-2 text-sm font-medium text-gray-700 focus:outline-none focus:ring-offset-2 focus:ring-[#303f7d] rounded-full" aria-expanded="false" aria-haspopup="true">
                        <span class="sr-only">Open login modal</span>
                        <img src="{{ asset('images/pfp.png') }}" alt="User Profile" class="w-8 h-8 sm:w-auto sm:h-auto rounded-full">
                        <div class="flex flex-col items-start text-xs">
                            <span class="text-[10px] sm:text-[12px] text-[#B5B7BF] hidden sm:block">مرحبا بك</span>
                            <span>تسجيل الدخول</span>
                        </div>
                        <svg class="block w-2.5 h-2.5 ms-1 transition-transform" xmlns="http://www.w3.org/2000/svg" width="8" height="6" viewBox="0 0 8 6" fill="none"><path d="M0.914031 1.71206L3.64411 4.898C3.68811 4.94932 3.7427 4.99052 3.80413 5.01877C3.86555 5.04702 3.93236 5.06164 3.99997 5.06164C4.06758 5.06164 4.13438 5.04702 4.19581 5.01877C4.25723 4.99052 4.31182 4.94932 4.35583 4.898L7.08591 1.71206C7.34645 1.40796 7.13044 0.938232 6.73005 0.938232H1.26911C0.868718 0.938232 0.652702 1.40796 0.914031 1.71206Z" fill="#0D1226"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
