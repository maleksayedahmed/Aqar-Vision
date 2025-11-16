<!-- resources/views/partials/login-email-modal.blade.php -->
<div id="login-email-modal"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md m-4 pt-12 p-8 relative flex flex-col items-center">

        <!-- Close Button -->
        <button id="close-login-email-modal"
            class="absolute top-4 left-4 w-6 h-6 bg-gray-800 text-white rounded-md flex items-center justify-center hover:bg-gray-700 transition-colors"
            aria-label="Close modal">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Back Button to return to the initial login options -->
        <button id="back-to-initial-login-modal"
            class="absolute top-5 right-4 text-gray-500 hover:text-black transition-colors" aria-label="Go back">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <!-- Logo -->
        <img src="{{ asset('images/logo.png') }}" class="w-[70px] h-[60px]" alt="logo">

        <!-- Heading -->
        <h2 class="text-[16px] font-bold text-gray-800 my-6">{{ __('common.login_with_email') }}</h2>

        <!-- Login Form -->
        <form id="login-email-form" action="{{ route('login') }}" method="POST" class="w-full space-y-5">
            @csrf
            <div>
                <label for="login-email"
                    class="block text-[11px] font-medium mb-2">{{ __('validation.attributes.email') }}</label>
                <div class="relative">
                    <input type="email" name="email" id="login-email" value="{{ old('email') }}"
                        placeholder="{{ __('common.enter_email') }}"
                        class="w-full border border-[rgba(216,218,220,1)] text-gray-700 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#303F7C]"
                        required>
                </div>
                {{-- This span will hold AJAX errors for the email field --}}
                <span class="error-message text-red-500 text-xs mt-1" data-field="email"></span>
            </div>

            <div>
                <label for="login-password"
                    class="block text-[11px] font-medium mb-2">{{ __('validation.attributes.password') }}</label>
                <div class="relative">
                    <button type="button" class="absolute inset-y-0 left-0 pl-4 flex items-center"
                        onclick="togglePasswordVisibility(this)">
                        <img src="{{ asset('images/hide.svg') }}" alt="Toggle visibility">
                    </button>
                    <input type="password" name="password" id="login-password"
                        placeholder="{{ __('common.confirm_password') }}"
                        class="w-full border border-[rgba(216,218,220,1)] text-gray-700 rounded-lg py-3 px-4 pl-12 focus:outline-none focus:ring-2 focus:ring-[#303F7C]"
                        required>
                </div>
                {{-- This span will hold AJAX errors for the password field --}}
                <span class="error-message text-red-500 text-xs mt-1" data-field="password"></span>
                <div class="text-left mt-2">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm text-gray-500 hover:text-blue-600 hover:underline">{{ __('validation.forgot_password') ?? 'هل نسيت كلمة المرور؟' }}</a>
                    @endif
                </div>
            </div>

            <div class="pt-3">
                <button type="submit"
                    class="w-full bg-[#303F7C] text-white font-bold py-3 rounded-lg hover:bg-opacity-90 transition-colors shadow-sm flex items-center justify-center disabled:opacity-75">
                    <svg class="spinner hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span class="button-text">{{ __('auth.login', [], app()->getLocale()) ?? 'تسجيل الدخول' }}</span>
                </button>
            </div>
        </form>

        <!-- Sign Up Link -->
        <p class="text-sm text-gray-600 pt-5">
            {{ __('common.new_to_app', ['app' => config('app.name')]) }}
            <button type="button" id="switch-to-signup-from-email-modal"
                class="font-semibold text-blue-600 hover:text-blue-700 underline">{{ __('common.create_account_now') }}</button>
        </p>
    </div>
</div>
