<div x-data="{ show: @entangle('show') }" x-show="show" x-on:keydown.escape.window="show = false"
    class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4">
        <!-- Backdrop -->
        <div x-show="show" x-transition:enter="transition-opacity ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-50" @click="show = false">
        </div>

        <!-- Modal -->
        <div x-show="show" x-transition:enter="transition-transform ease-out duration-300"
            x-transition:enter-start="translate-y-4 opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition-transform ease-in duration-200"
            x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="translate-y-4 opacity-0"
            class="relative bg-white rounded-lg shadow-xl w-full max-w-md p-6">

            <!-- Close button -->
            <button @click="show = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-500">
                <span class="sr-only">{{ __('common.close') ?? 'Close' }}</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Modal content -->
            <div class="text-center">
                <h2 class="text-2xl font-bold mb-6">{{ __('common.login') }}</h2>

                <form wire:submit.prevent="login" class="space-y-4">
                    <!-- Email -->
                    <div>
                        <input wire:model="email" type="email"
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="{{ __('validation.attributes.email') }}" required />
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <input wire:model="password" type="password"
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="{{ __('validation.attributes.password') }}" required />
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remember me -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input wire:model="remember" type="checkbox" class="form-checkbox">
                            <span class="mr-2">{{ __('common.remember_me') }}</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">
                            {{ __('common.forgot_password') }}
                        </a>
                    </div>

                    <!-- Login button -->
                    <button type="submit"
                        class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition duration-200">
                        {{ __('common.login') }}
                    </button>

                    <!-- Register link -->
                    <div class="text-center mt-4">
                        <span>{{ __('common.dont_have_account') }}</span>
                        <a href="{{ route('register') }}" class="text-blue-600 hover:underline">
                            {{ __('common.register_now') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
