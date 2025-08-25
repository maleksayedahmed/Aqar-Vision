<!-- resources/views/partials/signup-modal.blade.php -->
<div id="signup-modal" class="hidden fixed inset-0 bg-black bg-opacity-60 z-50 flex items-center justify-center p-4 transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl p-8 max-w-4xl w-[716px] relative transform transition-all duration-300">
        
        <button id="close-signup-modal" class="absolute top-5 left-5 bg-black rounded-md w-5 h-5 flex items-center justify-center text-white hover:bg-gray-800 focus:outline-none">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <button id="back-to-login-modal" class="absolute top-5 right-5 text-gray-400 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none"><path d="M1 13L7 7L1 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        
        <div class="flex flex-col items-center mb-5 text-center">
            <img src="{{ asset('images/logo.png') }}" class="w-[70px] h-[60px]" alt="logo">
            <div class="flex self-start items-center gap-1 mt-2">
                <h2 class="text-[16px] font-bold text-gray-800">سجل حساب جديد</h2>
            </div>
        </div>

        <form id="signup-form" action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="signup-name" class="block text-[11px] font-medium mb-2">الاسم</label>
                <input type="text" name="name" id="signup-name" value="{{ old('name') }}" required class="text-[11px] block w-full px-4 py-3 bg-white border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#303f7d]">
                <span class="error-message text-red-500 text-xs mt-1" data-field="name"></span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                <div>
                    <label for="signup-phone" class="block font-medium text-[11px] mb-2">أدخل رقم الهاتف</label>
                    <div class="flex rounded-lg border border-gray-300 focus-within:ring-2 focus-within:ring-[#303f7d]">
                        <input type="tel" name="phone" id="signup-phone" value="{{ old('phone') }}" required class="text-[11px] flex-1 block w-full px-4 py-3 border-0 rounded-lg placeholder-gray-400 focus:ring-0">
                        <div class="inline-flex items-center px-3 border-r gap-2 border-gray-300 text-gray-600 text-[15px]">
                            <span>966+</span>
                            <img src="{{ asset('images/saudi_flag.png') }}" alt="Saudi Arabia Flag" class="w-5 h-auto">
                        </div>
                    </div>
                     <span class="error-message text-red-500 text-xs mt-1" data-field="phone"></span>
                </div>

                <div>
                    <label for="signup-email" class="block text-[11px] font-medium mb-2">البريد الإلكتروني</label>
                    <input type="email" name="email" id="signup-email" value="{{ old('email') }}" required class="text-[11px] block w-full px-4 py-3 bg-white border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#303f7d]">
                    <span class="error-message text-red-500 text-xs mt-1" data-field="email"></span>
                </div>
                
                <div>
                    <label for="signup-password" class="block font-medium text-[11px] mb-2">كلمة المرور</label>
                    <input type="password" name="password" id="signup-password" required class="text-[11px] block w-full px-4 py-3 bg-white border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#303f7d]">
                    <span class="error-message text-red-500 text-xs mt-1" data-field="password"></span>
                </div>

                <div>
                    <label for="password_confirmation" class="text-[11px] block font-medium mb-2">تأكيد كلمة المرور</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="text-[11px] block w-full px-4 py-3 bg-white border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#303f7d]">
                </div>
            </div>

            <div class="mt-6 flex items-start">
                <div class="flex items-center h-5">
                    <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-[#303f7d] focus:ring-[#303f7d] border-gray-300 rounded">
                </div>
                <div class="ml-3 mr-3 text-sm">
                    <label for="terms" class="text-gray-800">
                        اوافق على <a href="#" class="font-medium text-blue-600 hover:text-blue-500">الشروط والاحكام للاستمرار</a>
                    </label>
                    <span class="error-message text-red-500 text-xs mt-1 block" data-field="terms"></span>
                </div>
            </div>

            <div class="mt-8 flex justify-center">
                <button type="submit" class="max-w-[313px] w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-lg font-medium text-white bg-[rgba(48,62,124,1)] hover:bg-[#29366d] disabled:opacity-75">
        <svg class="spinner hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span class="button-text">سجل الآن</span>
    </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-[12px] text-gray-600">
                لديك حساب بالفعل؟ <button id="switch-to-login-modal" class="font-bold text-gray-900 hover:underline">قم بتسجيل حسابك الان</button>
            </p>
        </div>
    </div>
</div>