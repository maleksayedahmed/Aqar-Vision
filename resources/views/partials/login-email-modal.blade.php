<!-- resources/views/partials/login-email-modal.blade.php -->
<div id="login-email-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md m-4 pt-12 p-8 relative flex flex-col items-center">
        
        <!-- Close Button -->
        <button id="close-login-email-modal" class="absolute top-4 left-4 w-6 h-6 bg-gray-800 text-white rounded-md flex items-center justify-center hover:bg-gray-700 transition-colors" aria-label="Close modal">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <!-- Back Button to return to the initial login options -->
        <button id="back-to-initial-login-modal" class="absolute top-5 right-4 text-gray-500 hover:text-black transition-colors" aria-label="Go back">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>

        <!-- Logo -->
        <img src="{{ asset('images/logo.png') }}" class="w-[70px] h-[60px]" alt="logo">

        <!-- Heading -->
        <h2 class="text-[16px] font-bold text-gray-800 my-6">تسجيل الدخول باستخدام البريد الإلكتروني</h2>
        
        <!-- Login Form -->
        <form action="{{ route('login') }}" method="POST" class="w-full space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-[11px] font-medium mb-2">البريد الإلكتروني</label>
                <div class="relative">
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="أدخل البريد الإلكتروني" class="w-full border border-[rgba(216,218,220,1)] text-gray-700 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#303F7C]" required>
                </div>
                {{-- This will show any authentication errors from Laravel --}}
                @error('email')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-[11px] font-medium mb-2">كلمة المرور</label>
                <div class="relative">
                    <button type="button" class="absolute inset-y-0 left-0 pl-4 flex items-center" onclick="togglePasswordVisibility(this)">
                        <img src="{{ asset('images/hide.svg') }}" alt="Toggle visibility">
                    </button>
                    <input type="password" name="password" id="password" placeholder="أدخل كلمة المرور" class="w-full border border-[rgba(216,218,220,1)] text-gray-700 rounded-lg py-3 px-4 pl-12 focus:outline-none focus:ring-2 focus:ring-[#303F7C]" required>
                </div>
                 @error('password')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
                <div class="text-left mt-2">
                    <a href="{{ route('password.request') }}" class="text-sm text-gray-500 hover:text-blue-600 hover:underline">هل نسيت كلمة المرور؟</a>
                </div>
            </div>
            
            <div class="pt-3">
                <button type="submit" class="w-full bg-[#303F7C] text-white font-bold py-3 rounded-lg hover:bg-opacity-90 transition-colors shadow-sm">
                    تسجيل الدخول
                </button>
            </div>
        </form>

        <!-- Sign Up Link -->
        <p class="text-sm text-gray-600 pt-5">
            عضو جديد في عقار فيجن؟ 
            <button type="button" id="switch-to-signup-from-email-modal" class="font-semibold text-blue-600 hover:text-blue-700 underline">قم بإنشاء حساب الآن</button>
        </p>
    </div>
</div>