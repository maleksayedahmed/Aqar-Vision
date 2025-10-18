<!-- resources/views/partials/login-phone-modal.blade.php -->
<div id="login-phone-modal"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md m-4 pt-12 p-8 relative flex flex-col items-center">

        <!-- Close Button -->
        <button id="close-login-phone-modal"
            class="absolute top-4 left-4 w-6 h-6 bg-gray-800 text-white rounded-md flex items-center justify-center hover:bg-gray-700"
            aria-label="Close modal">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Back Button -->
        <button id="back-to-initial-login-from-phone" class="absolute top-5 right-4 text-gray-500 hover:text-black"
            aria-label="Go back">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <!-- Logo -->
        <img src="{{ asset('images/logo.png') }}" class="w-[70px] h-[60px]" alt="logo">

        <!-- Heading -->
        <div class="text-center my-6">
            <h2 class="text-[16px] font-bold text-gray-800">{{ __('common.login_with_phone') }}</h2>
            <p class="text-[9.1px] font-medium mt-2 max-w-xs">
                {{ __('common.enter_phone') }}
            </p>
        </div>

        <!-- Login Form -->
        <form action="{{ route('login.phone.send') }}" method="POST" class="w-full space-y-6">
            @csrf
            <div>
                <label for="phone"
                    class="block text-[11px] font-medium mb-2">{{ __('validation.attributes.phone', [], app()->getLocale()) ?? 'رقم الجوال' }}</label>
                <div class="relative">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none gap-2">
                        <img src="{{ asset('images/saudi_flag.png') }}" alt="Saudi Arabia Flag"
                            class="w-6 h-4 object-cover">
                        <span class="text-[17px]">+966</span>
                        <div class="h-6 border-l border-gray-300 mx-1"></div>
                    </div>
                    <input type="tel" name="phone" id="phone" placeholder="5xxxxxxxx"
                        class="w-full border border-gray-200 text-gray-700 rounded-lg py-3 px-4 pr-28 text-left focus:outline-none focus:ring-2 focus:ring-[#303F7C]"
                        required>
                </div>
                @error('phone')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
                @if (session('status'))
                    <div class="text-green-500 text-xs mt-1">
                        {{ session('status') }}
                    </div>
                @endif
            </div>

            <div class="pt-3">
                <button type="submit"
                    class="w-full text-[14px] bg-[rgba(48,62,124,1)] text-white font-bold py-3 rounded-lg hover:bg-opacity-90 transition-colors shadow-sm">
                    {{ __('common.next') }}
                </button>
            </div>
        </form>

        <!-- Sign Up Link -->
        <p class="text-sm text-gray-600 pt-6">
            {{ __('common.new_to_app', ['app' => config('app.name')]) }}
            <button type="button" id="switch-to-signup-from-phone-modal"
                class="font-semibold text-blue-600 hover:text-blue-700 underline">{{ __('common.create_account_now') }}</button>
        </p>
    </div>
</div>
