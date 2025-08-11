@guest
{{-- ============================================= --}}
{{-- THIS HEADER IS SHOWN ONLY FOR GUESTS --}}
{{-- ============================================= --}}
<header id="main-header" class="py-[5px] bg-[linear-gradient(90deg,_#F6F8FF_0%,_#FFFFFF_100%)] sticky top-0 z-50 transition-transform duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4">
        <div class="flex flex-wrap items-center justify-between min-h-16 py-2">
            <!-- Left side - Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" class="w-[70px] h-[60px]" alt="logo">
                </a>
            </div>

            <!-- Right side - Controls -->
            <div class="flex items-center gap-x-2 lg:gap-x-4">
                <!-- Map Button -->
                <button class="flex bg-[rgba(48,63,125,1)] hover:bg-blue-700 text-white px-2 py-1 sm:px-4 sm:py-2 rounded-lg items-center gap-2 transition-colors duration-200 text-[9px] sm:text-sm font-medium shadow-sm">
                    <svg class="w-3 h-3 lg:w-4 lg:h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2C6.686 2 4 4.686 4 8c0 4.28 6 10 6 10s6-5.72 6-10c0-3.314-2.686-6-6-6zm0 8.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" clip-rule="evenodd"></path></svg>
                    <span>بحث على الخريطة</span>
                </button>

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
@endguest



@auth
{{-- ==================================================== --}}
{{-- THIS HEADER IS SHOWN ONLY FOR AUTHENTICATED USERS --}}
{{-- ==================================================== --}}
<header id="main-header" class="py-[5px] bg-[linear-gradient(90deg,_#F6F8FF_0%,_#FFFFFF_100%)] sticky top-0 z-50 transition-transform duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Mobile Menu Button (Hamburger) -->
            <div class="lg:hidden">
                <button id="mobile-menu-button" class="p-2 rounded-md text-gray-600 hover:text-gray-900 focus:outline-none">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
            <!-- Logo & Desktop Navigation -->
            <div class="flex items-center gap-[50px]">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" class="w-[70px] h-[60px]" alt="logo">
                </a>
                <div class="hidden lg:flex gap-[33px]">
                    <nav class="hidden lg:flex items-center gap-x-6">
                        <a href="{{ route('home') }}" class="text-sm font-medium text-gray-700 hover:text-[#303f7d]">الرئيسية</a>
                        <a href="#" class="text-sm font-medium text-gray-700 hover:text-[#303f7d]">وسطاء العقاريون</a>
                        <a href="#" class="text-sm font-medium text-gray-700 hover:text-[#303f7d]">نبذة عنا</a>
                        <a href="#" class="text-sm font-medium text-gray-700 hover:text-[#303f7d]">تواصل معنا</a>
                    </nav>
                </div>
            </div>
            <!-- Right side Controls -->
            <div class="flex items-center gap-x-4 lg:gap-x-[45px]">
                <div class="flex items-center gap-[12.5px]">
                    <!-- User Profile Dropdown -->
                    <div class="relative">
                        <button id="user-menu-button" type="button" class="flex items-center gap-x-2 text-sm font-medium text-gray-700 rounded-full" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            @if (Auth::user()->profile_photo_path)
                                {{-- If user has a photo, display it --}}
                                <img class="w-9 h-9 rounded-full object-cover" src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}">
                            @else
                                {{-- Otherwise, display initials --}}
                                <div class="flex items-center justify-center w-9 h-9 bg-gray-200 rounded-full font-semibold text-gray-600 text-xs">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </div>
                            @endif
                            <span class="hidden lg:inline">{{ Auth::user()->name }}</span>
                            <svg class="w-2.5 h-2.5 ms-1 transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 6" fill="none"><path d="M0.914031 1.71206L3.64411 4.898C3.68811 4.94932 3.7427 4.99052 3.80413 5.01877C3.86555 5.04702 3.93236 5.06164 3.99997 5.06164C4.06758 5.06164 4.13438 5.04702 4.19581 5.01877C4.25723 4.99052 4.31182 4.94932 4.35583 4.898L7.08591 1.71206C7.34645 1.40796 7.13044 0.938232 6.73005 0.938232H1.26911C0.868718 0.938232 0.652702 1.40796 0.914031 1.71206Z" fill="#0D1226"/></svg>
                        </button>

                        <div id="user-menu" class="hidden absolute left-[-30px] mt-4 w-[200px] origin-top-left rounded-lg bg-white p-5 shadow-lg" role="menu">
                            <div class="space-y-[10px]">
                                 <a href="{{ route('profile.edit') }}" class="flex items-center gap-[10px] text-[13px] font-light text-[#303f7d] transition-opacity hover:opacity-75" role="menuitem">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="14" viewBox="0 0 13 14" fill="none"><path d="M6.77894 7.44089C6.73386 7.43523 6.68825 7.43523 6.64317 7.44089C6.15724 7.4231 5.69771 7.21528 5.36345 6.86214C5.02918 6.509 4.84688 6.03877 4.85578 5.55259C4.86468 5.06642 5.06405 4.60317 5.41102 4.2625C5.75798 3.92182 6.2248 3.73096 6.71106 3.73096C7.19731 3.73096 7.66413 3.92182 8.0111 4.2625C8.35806 4.60317 8.55744 5.06642 8.56633 5.55259C8.57523 6.03877 8.39293 6.509 8.05867 6.86214C7.7244 7.21528 7.26487 7.4231 6.77894 7.44089Z" stroke="#303E7C" stroke-width="1.12978" stroke-linecap="round" stroke-linejoin="round"/><path d="M10.5242 11.1752C9.48455 12.1308 8.12327 12.6599 6.7112 12.6574C5.29912 12.6599 3.93785 12.1308 2.89819 11.1752C2.94757 10.8733 3.0629 10.5859 3.23597 10.3337C3.40905 10.0814 3.63561 9.87036 3.89953 9.71562C4.7503 9.21014 5.7216 8.94336 6.7112 8.94336C7.7008 8.94336 8.6721 9.21014 9.52286 9.71562C9.78679 9.87036 10.0134 10.0814 10.1864 10.3337C10.3595 10.5859 10.4748 10.8733 10.5242 11.1752Z" stroke="#303E7C" stroke-width="1.12978" stroke-linecap="round" stroke-linejoin="round"/><path d="M12.3685 7.00005C12.3685 8.11895 12.0367 9.21273 11.4151 10.1431C10.7935 11.0734 9.90991 11.7985 8.87618 12.2267C7.84245 12.6549 6.70496 12.7669 5.60756 12.5486C4.51015 12.3303 3.50212 11.7915 2.71094 11.0003C1.91975 10.2092 1.38095 9.20113 1.16266 8.10373C0.944373 7.00633 1.05641 5.86884 1.48459 4.8351C1.91278 3.80137 2.63789 2.91783 3.56822 2.2962C4.49855 1.67457 5.59233 1.34277 6.71123 1.34277C8.21164 1.34277 9.65059 1.93881 10.7115 2.99975C11.7725 4.0607 12.3685 5.49965 12.3685 7.00005Z" stroke="#303E7C" stroke-width="1.12978" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    <span>ملفي الشخصي</span>
                                </a>
                            </div>
                             <!-- Logout Form -->
                            <div class="w-full pt-6 flex justify-center">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-[6px] text-[13px] font-light text-[#D9534F] transition-opacity hover:opacity-75" role="menuitem">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none"><rect x="0.657959" y="0.157959" width="14.6842" height="14.6842" rx="7.3421" fill="#CB544B"/><path d="M7.89136 8.3905L8.76153 7.52032L7.89136 6.65015" stroke="white" stroke-width="0.489474" stroke-linecap="round" stroke-linejoin="round"/><path d="M5.28076 7.52026H8.73767" stroke="white" stroke-width="0.489474" stroke-linecap="round" stroke-linejoin="round"/><path d="M8 4.78067C8.36159 4.76376 8.72273 4.82253 9.0603 4.9532C9.39788 5.08388 9.70446 5.28359 9.96042 5.53955C10.2164 5.79551 10.4161 6.10209 10.5468 6.43967C10.6774 6.77724 10.7362 7.13838 10.7193 7.49997C10.7362 7.86156 10.6774 8.2227 10.5468 8.56027C10.4161 8.89785 10.2164 9.20442 9.96042 9.46039C9.70446 9.71635 9.39788 9.91606 9.0603 10.0467C8.72273 10.1774 8.36159 10.2362 8 10.2193" stroke="white" stroke-width="0.489474" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <span>تسجيل الخروج</span>
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile Menu Panel -->
        <div id="mobile-menu" class="hidden lg:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-[#303f7d] hover:bg-gray-50">الرئيسية</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-[#303f7d] hover:bg-gray-50">وسطاء العقاريون</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-[#303f7d] hover:bg-gray-50">نبذة عنا</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-[#303f7d] hover:bg-gray-50">تواصل معنا</a>
            </div>
        </div>
    </div>
</header>
@endauth