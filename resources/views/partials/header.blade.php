{{-- This file now handles both guest and authenticated users --}}

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

                <!-- User Profile Dropdown / Login Trigger -->
                <div class="relative">
                    <button id="open-login-modal" type="button" class="flex items-center gap-x-1 sm:gap-x-2 text-sm font-medium text-gray-700 focus:outline-none focus:ring-offset-2 focus:ring-[#303f7d] rounded-full" aria-expanded="false" aria-haspopup="true">
                        <span class="sr-only">Open user menu</span>
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

<!-- Login Modal -->
<div id="login-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 transition-opacity duration-300">
    <div class="bg-white rounded-2xl pt-12 shadow-xl w-full max-w-md m-4 p-8 relative flex flex-col items-center gap-y-5">
        <!-- Close Button -->
        <button id="close-login-modal" class="absolute top-4 left-4 w-8 h-8 bg-gray-800 text-white rounded-md flex items-center justify-center hover:bg-gray-700 transition-colors" aria-label="Close modal">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <!-- Logo -->
        <img src="{{ asset('images/logo.png') }}" class="w-[70px] h-[60px]" alt="logo">
        <!-- Heading -->
        <h2 class="text-[16px] font-bold text-[rgba(26,26,26,1)]">تسجيل الدخول لحسابك</h2>
        <!-- Social Logins -->
        <div class="w-full space-y-3">
            <button class="w-full border border-gray-300 rounded-lg py-3 px-4 font-bold text-[14px] flex items-center gap-[21px] hover:bg-gray-50 transition-colors">
                <img src="{{ asset('images/Google.svg') }}" alt="Google">
                <span>متابعة مع جوجل</span>
            </button>
             <button class="w-full border border-gray-300 rounded-lg py-3 px-4 text-center font-bold text-[14px] flex items-center gap-[21px] hover:bg-gray-50 transition-colors">
                <img src="{{ asset('images/Apple.svg') }}" alt="Apple">
                <span>متابعة مع ابل</span>
            </button>
        </div>
        <!-- Separator -->
        <div class="text-gray-500 font-medium">أو</div>
        <!-- Other Login Methods -->
        <div class="w-full space-y-3">
            <a href="{{ route('login') }}" class="w-full border border-gray-300 rounded-lg py-3 px-4 text-center font-bold text-[14px] flex items-center gap-[14px] hover:bg-gray-50 transition-colors">
                <img src="{{ asset('images/email-dark.svg') }}" alt="Email">
                <span>تسجيل الدخول باستخدام البريد الإلكتروني</span>
            </a>
            <button class="w-full border border-gray-300 rounded-lg py-3 px-4 text-center font-bold text-[14px] flex items-center gap-[14px] hover:bg-gray-50 transition-colors">
                <img src="{{ asset('images/phone-dark.png') }}" alt="Phone">
                <span>تسجيل الدخول باستخدام رقم الجوال</span>
            </button>
        </div>
        <!-- Sign Up Link -->
        <p class="text-sm text-gray-600 pt-3">
            عضو جديد في عقار فيجن؟ 
            <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-700 underline">قم بإنشاء حساب الآن</a>
        </p>
    </div>
</div>
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
                    <!-- Messages Icon -->
                    <button class="hidden lg:block relative rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M15.875 3.37671C15.875 2.83281 16.0363 2.30113 16.3385 1.84889C16.6406 1.39666 17.0701 1.04418 17.5726 0.836042C18.0751 0.627901 18.6281 0.573441 19.1615 0.679551C19.6949 0.78566 20.1849 1.04757 20.5695 1.43217C20.9541 1.81676 21.216 2.30676 21.3222 2.84021C21.4283 3.37366 21.3738 3.92659 21.1657 4.42909C20.9575 4.93159 20.6051 5.36108 20.1528 5.66325C19.7006 5.96543 19.1689 6.12671 18.625 6.12671C17.8959 6.12597 17.1968 5.836 16.6813 5.32044C16.1657 4.80487 15.8757 4.10583 15.875 3.37671ZM20.625 8.52301V13.3367C20.625 13.992 20.4959 14.6409 20.2452 15.2463C19.9944 15.8517 19.6268 16.4018 19.1635 16.8652C18.7001 17.3286 18.15 17.6961 17.5446 17.9469C16.9392 18.1977 16.2903 18.3267 15.635 18.3267H14.125C13.9702 18.3267 13.8174 18.3627 13.6789 18.4318C13.5403 18.5008 13.4196 18.6012 13.3264 18.7248L11.825 20.7167C11.6961 20.9181 11.5187 21.0838 11.309 21.1985C11.0993 21.3133 10.8641 21.3734 10.625 21.3734C10.3859 21.3734 10.1507 21.3133 9.94103 21.1985C9.73133 21.0838 9.55387 20.9181 9.425 20.7167L7.925 18.7267C7.82662 18.6083 7.70472 18.5116 7.567 18.4427C7.42929 18.3739 7.27878 18.3344 7.125 18.3267H5.625C4.29892 18.3267 3.02715 17.8 2.08947 16.8623C1.15178 15.9246 0.625 14.6528 0.625 13.3267V6.37674C0.625 5.05066 1.15178 3.77889 2.08947 2.84121C3.02715 1.90352 4.29892 1.37674 5.625 1.37674H13.4787C13.6265 1.37719 13.7723 1.41049 13.9056 1.47425C14.0389 1.53801 14.1564 1.63062 14.2495 1.74538C14.3426 1.86014 14.409 1.99417 14.4439 2.13776C14.4788 2.28135 14.4813 2.43091 14.4513 2.5756C14.3411 3.15739 14.3506 3.75553 14.4792 4.33353C14.6549 5.11217 15.0478 5.82504 15.6123 6.38947C16.1767 6.9539 16.8896 7.34678 17.6682 7.52253C18.2462 7.65114 18.8443 7.66063 19.4261 7.55042C19.5708 7.52039 19.7204 7.52292 19.864 7.55782C20.0076 7.59272 20.1416 7.65913 20.2564 7.75223C20.3711 7.84533 20.4637 7.96279 20.5275 8.0961C20.5912 8.22941 20.6246 8.37524 20.625 8.52301ZM7.625 10.3767C7.625 10.1789 7.56635 9.98559 7.45647 9.82114C7.34659 9.65669 7.19041 9.52852 7.00768 9.45283C6.82496 9.37714 6.62389 9.35734 6.42991 9.39592C6.23593 9.43451 6.05775 9.52975 5.91789 9.6696C5.77804 9.80946 5.6828 9.98764 5.64421 10.1816C5.60563 10.3756 5.62543 10.5767 5.70112 10.7594C5.77681 10.9421 5.90498 11.0983 6.06943 11.2082C6.23388 11.3181 6.42722 11.3767 6.625 11.3767C6.88997 11.3759 7.14387 11.2703 7.33123 11.0829C7.5186 10.8956 7.62421 10.6417 7.625 10.3767ZM11.625 10.3767C11.625 10.1789 11.5664 9.98559 11.4565 9.82114C11.3466 9.65669 11.1904 9.52852 11.0077 9.45283C10.825 9.37714 10.6239 9.35734 10.4299 9.39592C10.2359 9.43451 10.0577 9.52975 9.91789 9.6696C9.77804 9.80946 9.6828 9.98764 9.64421 10.1816C9.60563 10.3756 9.62543 10.5767 9.70112 10.7594C9.77681 10.9421 9.90498 11.0983 10.0694 11.2082C10.2339 11.3181 10.4272 11.3767 10.625 11.3767C10.89 11.3759 11.1439 11.2703 11.3312 11.0829C11.5186 10.8956 11.6242 10.6417 11.625 10.3767ZM15.625 10.3767C15.625 10.1789 15.5664 9.98559 15.4565 9.82114C15.3466 9.65669 15.1904 9.52852 15.0077 9.45283C14.825 9.37714 14.6239 9.35734 14.4299 9.39592C14.2359 9.43451 14.0577 9.52975 13.9179 9.6696C13.778 9.80946 13.6828 9.98764 13.6442 10.1816C13.6056 10.3756 13.6254 10.5767 13.7011 10.7594C13.7768 10.9421 13.905 11.0983 14.0694 11.2082C14.2339 11.3181 14.4272 11.3767 14.625 11.3767C14.89 11.3759 15.1439 11.2703 15.3312 11.0829C15.5186 10.8956 15.6242 10.6417 15.625 10.3767Z" fill="#303E7C"/></svg>
                        <span class="absolute top-0 flex h-3 w-3"><span class="relative inline-flex rounded-full h-2 w-2 bg-yellow-400 ring-1 ring-white"></span></span>
                    </button>

                    <!-- User Profile Dropdown -->
                    <div class="relative">
                        <button id="user-menu-button" type="button" class="flex items-center gap-x-2 text-sm font-medium text-gray-700 rounded-full" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <div class="flex items-center justify-center w-9 h-9 bg-gray-200 rounded-full font-semibold text-gray-600 text-xs">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <span class="hidden lg:inline">{{ Auth::user()->name }}</span>
                            <svg class="w-2.5 h-2.5 ms-1 transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 6" fill="none"><path d="M0.914031 1.71206L3.64411 4.898C3.68811 4.94932 3.7427 4.99052 3.80413 5.01877C3.86555 5.04702 3.93236 5.06164 3.99997 5.06164C4.06758 5.06164 4.13438 5.04702 4.19581 5.01877C4.25723 4.99052 4.31182 4.94932 4.35583 4.898L7.08591 1.71206C7.34645 1.40796 7.13044 0.938232 6.73005 0.938232H1.26911C0.868718 0.938232 0.652702 1.40796 0.914031 1.71206Z" fill="#0D1226"/></svg>
                        </button>

                        <div id="user-menu" class="hidden absolute left-[-30px] mt-4 w-[200px] origin-top-left rounded-lg bg-white p-5 shadow-lg" role="menu">
                             <!-- Dropdown Links -->
                            <div class="space-y-[10px]">
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-[10px] text-[13px] font-light text-[#303f7d] transition-opacity hover:opacity-75" role="menuitem">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="14" viewBox="0 0 13 14" fill="none"><path d="M6.77894 7.44089C6.73386 7.43523 6.68825 7.43523 6.64317 7.44089C6.15724 7.4231 5.69771 7.21528 5.36345 6.86214C5.02918 6.509 4.84688 6.03877 4.85578 5.55259C4.86468 5.06642 5.06405 4.60317 5.41102 4.2625C5.75798 3.92182 6.2248 3.73096 6.71106 3.73096C7.19731 3.73096 7.66413 3.92182 8.0111 4.2625C8.35806 4.60317 8.55744 5.06642 8.56633 5.55259C8.57523 6.03877 8.39293 6.509 8.05867 6.86214C7.7244 7.21528 7.26487 7.4231 6.77894 7.44089Z" stroke="#303E7C" stroke-width="1.12978" stroke-linecap="round" stroke-linejoin="round"/><path d="M10.5242 11.1752C9.48455 12.1308 8.12327 12.6599 6.7112 12.6574C5.29912 12.6599 3.93785 12.1308 2.89819 11.1752C2.94757 10.8733 3.0629 10.5859 3.23597 10.3337C3.40905 10.0814 3.63561 9.87036 3.89953 9.71562C4.7503 9.21014 5.7216 8.94336 6.7112 8.94336C7.7008 8.94336 8.6721 9.21014 9.52286 9.71562C9.78679 9.87036 10.0134 10.0814 10.1864 10.3337C10.3595 10.5859 10.4748 10.8733 10.5242 11.1752Z" stroke="#303E7C" stroke-width="1.12978" stroke-linecap="round" stroke-linejoin="round"/><path d="M12.3685 7.00005C12.3685 8.11895 12.0367 9.21273 11.4151 10.1431C10.7935 11.0734 9.90991 11.7985 8.87618 12.2267C7.84245 12.6549 6.70496 12.7669 5.60756 12.5486C4.51015 12.3303 3.50212 11.7915 2.71094 11.0003C1.91975 10.2092 1.38095 9.20113 1.16266 8.10373C0.944373 7.00633 1.05641 5.86884 1.48459 4.8351C1.91278 3.80137 2.63789 2.91783 3.56822 2.2962C4.49855 1.67457 5.59233 1.34277 6.71123 1.34277C8.21164 1.34277 9.65059 1.93881 10.7115 2.99975C11.7725 4.0607 12.3685 5.49965 12.3685 7.00005Z" stroke="#303E7C" stroke-width="1.12978" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    <span>ملفي الشخصي</span>
                                </a>
                                <!-- ... Other links -->
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