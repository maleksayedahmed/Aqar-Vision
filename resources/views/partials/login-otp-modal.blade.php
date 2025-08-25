<!-- resources/views/partials/login-otp-modal.blade.php -->
<div id="otp-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md m-4 pt-12 p-8 relative flex flex-col items-center">
        
        <button id="close-otp-modal" class="absolute top-4 left-4 w-6 h-6 bg-gray-800 text-white rounded-md flex items-center justify-center hover:bg-gray-700" aria-label="Close modal">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <button id="back-to-login-phone-modal" class="absolute top-5 right-4 text-gray-500 hover:text-black" aria-label="Go back">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>
        
        <img src="{{ asset('images/logo.png') }}" class="w-[70px] h-[60px]" alt="logo">
        
        <div class="text-center my-6">
            <h2 class="text-[16px] font-bold text-gray-800">رمز التحقق</h2>
            <p class="text-[9.1px] mt-2 max-w-xs">ادخل رمز التحقق المرسل الى رقم هاتفك.</p>
             @if (session('status'))
                <div class="text-green-500 text-xs mt-2 font-semibold">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        
        <form action="{{ route('login.phone.verify') }}" method="POST" class="w-full">
            @csrf
            <input type="hidden" name="otp" id="otp-full-input">
            
            <div id="otp-inputs" class="flex justify-center gap-3 mb-8" dir="ltr">
                <input type="text" maxlength="1" class="otp-input w-16 h-16 text-center text-2xl font-semibold border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#303F7C]">
                <input type="text" maxlength="1" class="otp-input w-16 h-16 text-center text-2xl font-semibold border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#303F7C]">
                <input type="text" maxlength="1" class="otp-input w-16 h-16 text-center text-2xl font-semibold border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#303F7C]">
                <input type="text" maxlength="1" class="otp-input w-16 h-16 text-center text-2xl font-semibold border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#303F7C]">
            </div>
            @error('otp')
                <p class="text-red-500 text-xs text-center -mt-4 mb-4">{{ $message }}</p>
            @enderror
            
            <div class="pt-3">
                <button type="submit" class="w-full bg-[rgba(48,62,124,1)] text-white font-bold py-3 rounded-lg hover:bg-opacity-90 transition-colors shadow-sm">
                    التحقق
                </button>
            </div>
        </form>

        <p class="text-sm text-gray-600 pt-8">
            عضو جديد في عقار فيجن؟ 
            <button type="button" id="switch-to-signup-from-otp-modal" class="font-semibold text-blue-600 hover:text-blue-700 underline">قم بإنشاء حساب الآن</button>
        </p>
    </div>
</div>