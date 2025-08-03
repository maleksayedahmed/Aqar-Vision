{{-- resources/views/partials/login-modal.blade.php --}}
<div id="login-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
<div class="bg-white rounded-2xl pt-12 shadow-xl w-full max-w-md m-4 p-8 relative flex flex-col items-center gap-y-5">
<button id="close-login-modal" class="absolute top-4 left-4 w-8 h-8 bg-gray-800 text-white rounded-md flex items-center justify-center">
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
</button>
<img src="{{ asset('images/logo.png') }}" class="w-[70px] h-[60px]" alt="logo">
<h2 class="text-[16px] font-bold">تسجيل الدخول لحسابك</h2>
<div class="w-full space-y-3">
<a href="#" class="w-full border border-gray-300 rounded-lg py-3 px-4 font-bold text-[14px] flex items-center gap-[21px]">
<img src="{{ asset('images/Google.svg') }}" alt="Google">
<span>متابعة مع جوجل</span>
</a>
<a href="#" class="w-full border border-gray-300 rounded-lg py-3 px-4 font-bold text-[14px] flex items-center gap-[21px]">
<img src="{{ asset('images/Apple.svg') }}" alt="Apple">
<span>متابعة مع ابل</span>
</a>
</div>
<div class="text-gray-500 font-medium">أو</div>
<div class="w-full space-y-3">
<a href="{{ route('login') }}" class="w-full border border-gray-300 rounded-lg py-3 px-4 font-bold text-[14px] flex items-center gap-[14px]">
<img src="{{ asset('images/email-dark.svg') }}" alt="Email">
<span>تسجيل الدخول باستخدام البريد الإلكتروني</span>
</a>
{{-- Add other login methods if available --}}
</div>
<p class="text-sm text-gray-600 pt-3">
عضو جديد في عقار فيجن؟
<a href="{{ route('register') }}" class="font-semibold text-blue-600 underline">قم بإنشاء حساب الآن</a>
</p>
</div>
</div>