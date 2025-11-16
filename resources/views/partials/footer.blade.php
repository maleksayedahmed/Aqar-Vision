{{-- resources/views/partials/footer.blade.php --}}
<footer class="bg-[#364371] text-white" dir="rtl">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row lg:justify-between gap-16 lg:gap-8 text-center lg:text-right">
            <!-- Column 1: Logo & Description -->
            <div class="flex flex-col items-center lg:items-start lg:w-[275px]">
                <img src="{{ asset('images/logo_light.png') }}" alt="Aqarvision Logo" class="h-16 mb-4">
                <p class="text-white/80 leading-relaxed font-medium">
                    {{ __('common.footer_description') }}
                </p>
                <!-- Social Media -->
                <div class="text-center gap-[12px] mt-10">
                    <div class="flex flex-row-reverse items-center justify-center gap-4">
                        <a href="#" class="group transition">
                            <span
                                class="w-10 h-10 rounded-full bg-transparent group-hover:bg-white transition-colors flex items-center justify-center">
                                <img class="w-5 h-5 invert group-hover:invert-0 transition"
                                    src="{{ asset('images/youtube-dark.svg') }}" alt="YouTube">
                            </span>
                        </a>
                        <a href="#" class="group transition">
                            <span
                                class="w-10 h-10 rounded-full bg-transparent group-hover:bg-white transition-colors flex items-center justify-center">
                                <img class="w-5 h-5 invert group-hover:invert-0 transition"
                                    src="{{ asset('images/tiktok-dark.svg') }}" alt="TikTok">
                            </span>
                        </a>
                        <a href="#" class="group transition">
                            <span
                                class="w-10 h-10 rounded-full bg-transparent group-hover:bg-white transition-colors flex items-center justify-center">
                                <img class="w-5 h-5 invert group-hover:invert-0 transition"
                                    src="{{ asset('images/insta-dark.svg') }}" alt="Instagram">
                            </span>
                        </a>
                        <a href="#" class="group transition">
                            <span
                                class="w-10 h-10 rounded-full bg-transparent group-hover:bg-white transition-colors flex items-center justify-center">
                                <img class="w-5 h-5 invert group-hover:invert-0 transition"
                                    src="{{ asset('images/fb-dark.svg') }}" alt="Facebook">
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Column 2: Quick Links -->
            <div class="flex flex-col items-center lg:items-start">
                <h3 class="text-xl font-bold mb-6">{{ __('common.quick_links') }}</h3>
                <div class="flex flex-col gap-3">
                    <a href="#" class="text-white/80 hover:text-white">{{ __('common.search') }}</a>
                    <a href="#" class="text-white/80 hover:text-white">{{ __('common.latest_properties') }}</a>
                </div>
            </div>
            <!-- Column 3: Contact Us -->
            <div class="flex flex-col items-center lg:items-start">
                <h3 class="text-xl font-bold mb-6">{{ __('common.contact_us') }}</h3>
                <div class="flex flex-col gap-4 w-full max-w-xs mx-auto lg:mx-0">
                    <a href="tel:0509777"
                        class="w-[260px] bg-[rgba(26,36,76,1)] p-4 rounded-xl flex items-center justify-between">
                        {{-- Phone SVG and details --}}
                        <div class="text-right">
                            <p class="text-xs text-white/70">{{ __('common.call_us_now') }}</p>
                            <p class="font-semibold">0509777</p>
                        </div>
                    </a>
                    <a href="mailto:aqarvition@gmail.com"
                        class="w-[260px] bg-[rgba(26,36,76,1)] p-4 rounded-xl flex items-center justify-between">
                        {{-- Email SVG and details --}}
                        <div class="text-right">
                            <p class="text-xs text-white/70">{{ __('common.get_in_touch') }}</p>
                            <p class="font-semibold">aqarvition@gmail.com</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="border-t border-white/10 pt-8 mt-12 text-center">
            <p class="text-white/60 text-sm">{{ __('common.copyright', ['year' => date('Y')]) }}</p>
        </div>
    </div>
</footer>
