<!-- resources/views/partials/login-modal.blade.php -->
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
            <button type="button" id="switch-to-login-email-modal" class="w-full border border-gray-300 rounded-lg py-3 px-4 text-center font-bold text-[14px] flex items-center gap-[14px] hover:bg-gray-50 transition-colors">
                <img src="{{ asset('images/email-dark.svg') }}" alt="Email">
                <span>تسجيل الدخول باستخدام البريد الإلكتروني</span>
            </button>
            <button type="button" id="switch-to-login-phone-modal" class="w-full border border-gray-300 rounded-lg py-3 px-4 text-center font-bold text-[14px] flex items-center gap-[14px] hover:bg-gray-50 transition-colors">
                <img src="{{ asset('images/phone-dark.png') }}" alt="Phone">
                <span>تسجيل الدخول باستخدام رقم الجوال</span>
            </button>
        </div>

        <!-- Sign Up Link -->
        <p class="text-sm text-gray-600 pt-3">
            عضو جديد في عقار فيجن؟ 
            <button type="button" id="switch-to-signup-modal" class="font-semibold text-blue-600 hover:text-blue-700 underline">قم بإنشاء حساب الآن</button>
        </p>
    </div>
</div>