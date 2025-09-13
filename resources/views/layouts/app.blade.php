{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-light.png') }}" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-dark.png') }}" media="(prefers-color-scheme: light)">


    {{-- The title will be dynamic for each page --}}
    <title>@yield('title', 'Aqarvision')</title>

    {{-- CSS Links using the asset() helper for proper URL generation --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- THIS REDUNDANT ALPINE.JS SCRIPT HAS BEEN REMOVED TO PREVENT CONFLICTS WITH LIVEWIRE --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    {{-- This line is required for Livewire component styles --}}
    @livewireStyles

    {{-- This allows adding extra styles from child pages if needed --}}
    @stack('styles')
</head>
<body class="bg-white">
    {{-- Guest-only modals are included below via partials --}}

    @auth
        @if (Auth::user()->agent)
            @include('partials.agent-header')
        @else
            @include('partials.header')
        @endif
    @else
        @include('partials.guest-header')
    @endauth

    {{-- 2. This is where the unique page content will be injected --}}
    <main>
        @yield('content')
    </main>

    {{-- 3. Include the Footer Partial --}}
    @auth
        @if (Auth::user()->agent)
            @include('partials.agent-footer')
        @else
            @include('partials.footer')
        @endif
    @else
        @include('partials.footer')
    @endauth


    {{-- For guests, include all modals needed for the auth flow --}}
    @guest
        @include('partials.login-modal')
        @include('partials.signup-modal')
        @include('partials.login-email-modal')
        @include('partials.login-phone-modal')
        @include('partials.login-otp-modal')
    @endguest


    @auth
{{-- ================================================= --}}
{{-- Upgrade Account Modal --}}
{{-- ================================================= --}}
<div id="upgrade-account-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg m-4 relative">
        <!-- Inner scrollable container: keeps modal centered but allows long content to scroll -->
        <div class="p-6 sm:p-8 flex flex-col items-center max-h-[80vh] overflow-y-auto">

        <!-- Close Button -->
        <button id="close-upgrade-modal" class="absolute top-4 left-4 w-6 h-6 bg-gray-200 text-gray-800 rounded-full flex items-center justify-center hover:bg-gray-300 transition-colors" aria-label="Close modal">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

    <!-- Logo -->
    <img src="{{ asset('images/logo.png') }}" class="w-[56px] h-[48px]" alt="logo">

    <!-- Heading -->
    <h2 class="text-lg font-bold text-gray-800 my-3">طلب ترقية الحساب</h2>
    <p class="text-sm text-gray-500 mb-4 text-center">اختر الدور الذي ترغب في الترقية إليه. ستتم مراجعة طلبك من قبل الإدارة.</p>

        <!-- Upgrade Form -->
        <form id="upgrade-request-form" action="{{ route('user.upgrade.request') }}" method="POST" class="w-full space-y-5">
            @csrf

            <!-- Personal Information -->
            <div class="space-y-4 mb-6">
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">الاسم</label>
                    <input type="text" name="name" id="name" value="{{ Auth::user()->name }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="أدخل اسمك الكامل">
                </div>

                <div class="space-y-2">
                    <label for="phone" class="block text-sm font-medium text-gray-700">رقم الهاتف</label>
                    <input type="tel" name="phone" id="phone" value="{{ Auth::user()->phone }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="أدخل رقم هاتفك">
                </div>
            </div>

            <fieldset class="space-y-4">
                <legend class="sr-only">Select a role</legend>

                <!-- Agent Option -->
                <div class="relative">
                    <input class="sr-only peer" type="radio" value="agent" name="requested_role" id="role_agent" checked>
                    <label class="flex p-5 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:ring-blue-500 peer-checked:ring-2 peer-checked:border-transparent" for="role_agent">
                        <div class="flex flex-col">
                           <span class="text-lg font-bold">وسيط عقاري / فردي</span>
                           <span class="text-sm text-gray-500 mt-1">إذا كنت تعمل كوسيط عقاري مستقل.</span>
                        </div>
                    </label>
                </div>

                <!-- Agency Option -->
                <div class="relative">
                    <input class="sr-only peer" type="radio" value="agency" name="requested_role" id="role_agency">
                    <label class="flex p-5 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:ring-blue-500 peer-checked:ring-2 peer-checked:border-transparent" for="role_agency">
                        <div class="flex flex-col">
                           <span class="text-lg font-bold">شركة / مكتب عقاري</span>
                           <span class="text-sm text-gray-500 mt-1">إذا كنت تمثل شركة أو مكتبًا عقاريًا مرخصًا.</span>
                        </div>
                    </label>
                </div>
            </fieldset>

            <!-- FAL License Field (only shown for agent requests) -->
            <div id="fal-license-field" class="space-y-4">
                <div class="space-y-2">
                    <label for="upgrade_fal_license" class="block text-sm font-medium text-gray-700">رقم رخصة فال (اختياري)</label>
                    <input type="text" name="fal_license" id="upgrade_fal_license"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="أدخل رقم رخصة فال">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="upgrade_license_issue_date" class="block text-sm font-medium text-gray-700">تاريخ إصدار الرخصة (اختياري)</label>
                        <input type="date" name="license_issue_date" id="upgrade_license_issue_date"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div class="space-y-2">
                        <label for="upgrade_license_expiry_date" class="block text-sm font-medium text-gray-700">تاريخ انتهاء الرخصة (اختياري)</label>
                        <input type="date" name="license_expiry_date" id="upgrade_license_expiry_date"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Agency Fields (only shown for agency requests) -->
            @php
                $agencyTypes = \App\Models\AgencyType::where('is_active', true)->orderBy('id')->get();
            @endphp
            <div id="agency-fields" class="space-y-4 hidden">
                <div class="space-y-2">
                    <label for="agency_name" class="block text-sm font-medium text-gray-700">اسم الشركة / المكتب</label>
                    <input type="text" name="agency_name" id="agency_name" placeholder="أدخل اسم الشركة" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="agency_type_id" class="block text-sm font-medium text-gray-700">نوع الشركة</label>
                        <select name="agency_type_id" id="agency_type_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">اختر نوع الشركة</option>
                            @foreach($agencyTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label for="commercial_register_number" class="block text-sm font-medium text-gray-700">سجل تجاري</label>
                        <input type="text" name="commercial_register_number" id="commercial_register_number" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="رقم السجل التجاري (اختياري)">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="commercial_issue_date" class="block text-sm font-medium text-gray-700">تاريخ إصدار السجل</label>
                        <input type="date" name="commercial_issue_date" id="commercial_issue_date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div class="space-y-2">
                        <label for="commercial_expiry_date" class="block text-sm font-medium text-gray-700">تاريخ انتهاء السجل</label>
                        <input type="date" name="commercial_expiry_date" id="commercial_expiry_date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="tax_id" class="block text-sm font-medium text-gray-700">الرقم الضريبي</label>
                        <input type="text" name="tax_id" id="tax_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="الرقم الضريبي (اختياري)">
                    </div>

                    <div class="space-y-2">
                        <label for="tax_issue_date" class="block text-sm font-medium text-gray-700">تاريخ إصدار الضريبة</label>
                        <input type="date" name="tax_issue_date" id="tax_issue_date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="tax_expiry_date" class="block text-sm font-medium text-gray-700">تاريخ انتهاء الضريبة</label>
                        <input type="date" name="tax_expiry_date" id="tax_expiry_date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div class="space-y-2">
                        <label for="address" class="block text-sm font-medium text-gray-700">العنوان</label>
                        <input type="text" name="address" id="address" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="عنوان المكتب (اختياري)">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">هاتف المكتب</label>
                        <input type="tel" name="phone_number" id="phone_number" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="هاتف المكتب (اختياري)">
                    </div>

                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">البريد الإلكتروني للمكتب</label>
                        <input type="email" name="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="البريد الإلكتروني للمكتب (اختياري)">
                    </div>
                </div>
            </div>

            <div id="upgrade-form-error" class="hidden text-right text-red-500 text-sm p-2 bg-red-50 rounded-lg"></div>
            <div class="pt-3">
                <button type="submit" class="w-full bg-[#303F7C] text-white font-bold py-3 rounded-lg hover:bg-opacity-90 transition-colors shadow-sm flex items-center justify-center disabled:opacity-75">
                    <svg class="spinner hidden animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="button-text">إرسال طلب الترقية</span>
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
@endauth
{{-- ================================================= --}}
{{-- Success Alert Modal --}}
{{-- ================================================= --}}
<div id="success-alert-modal" class="hidden fixed inset-0 z-[60] flex items-center justify-center bg-black bg-opacity-60 transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm m-4 pt-10 pb-8 relative flex flex-col items-center transform transition-all scale-95 opacity-0">

        <!-- Icon -->
        <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center absolute -top-10">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>

        <!-- Heading -->
        <h2 id="success-alert-title" class="text-2xl font-bold text-gray-800 my-4">تم بنجاح</h2>
        <p id="success-alert-message" class="text-base text-gray-500 mb-8 text-center px-4">تم إرسال طلبك بنجاح.</p>

        <button id="close-success-alert" class="bg-[#303F7C] text-white font-bold py-3 px-12 rounded-lg hover:bg-opacity-90 transition-colors shadow-md">
            حسناً
        </button>
    </div>
</div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- General Header and Dropdown Logic ---
            const menuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (menuButton && mobileMenu) {
                menuButton.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            const header = document.getElementById('main-header');
            let lastScrollY = window.scrollY;

            if (header) {
                window.addEventListener('scroll', () => {
                    const currentScrollY = window.scrollY;
                    if (currentScrollY <= 0 || currentScrollY < lastScrollY) {
                        header.classList.remove('-translate-y-full');
                    } else {
                        header.classList.add('-translate-y-full');
                    }
                    lastScrollY = currentScrollY < 0 ? 0 : currentScrollY;
                });
            }

            const userMenuButton = document.getElementById('user-menu-button');
            const userMenu = document.getElementById('user-menu');

            if (userMenuButton && userMenu) {
                userMenuButton.addEventListener('click', (event) => {
                    event.stopPropagation();
                    userMenu.classList.toggle('hidden');
                    userMenuButton.setAttribute('aria-expanded', !userMenu.classList.contains('hidden'));
                });

                window.addEventListener('click', (event) => {
                    if (userMenu && !userMenu.classList.contains('hidden') && !userMenu.contains(event.target) && !userMenuButton.contains(event.target)) {
                        userMenu.classList.add('hidden');
                        userMenuButton.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            // --- FULL MODAL SWITCHING LOGIC ---
            const loginModal = document.getElementById('login-modal');
            const signupModal = document.getElementById('signup-modal');
            const loginEmailModal = document.getElementById('login-email-modal');
            const loginPhoneModal = document.getElementById('login-phone-modal');
            const otpModal = document.getElementById('otp-modal');

            const allModals = [loginModal, signupModal, loginEmailModal, loginPhoneModal, otpModal];

            // All Buttons that control modals
            const openLoginModalBtn = document.getElementById('open-login-modal');
            const closeButtons = document.querySelectorAll('#close-login-modal, #close-signup-modal, #close-login-email-modal, #close-login-phone-modal, #close-otp-modal');

            const switchToSignupBtns = document.querySelectorAll('#switch-to-signup-modal, #switch-to-signup-from-email-modal, #switch-to-signup-from-phone-modal, #switch-to-signup-from-otp-modal');
            const switchToLoginBtns = document.querySelectorAll('#switch-to-login-modal, #back-to-initial-login-modal, #back-to-initial-login-from-phone');
            const switchToLoginEmailBtn = document.getElementById('switch-to-login-email-modal');
            const switchToLoginPhoneBtn = document.getElementById('switch-to-login-phone-modal');
            const backToLoginPhoneBtn = document.getElementById('back-to-login-phone-modal');

            // General function to show a specific modal
            const showModal = (modalToShow) => {
                allModals.forEach(modal => modal && modal.classList.add('hidden'));
                if (modalToShow) modalToShow.classList.remove('hidden');
            };
            const closeAllModals = () => allModals.forEach(modal => modal && modal.classList.add('hidden'));

            // Event Listeners
            if (openLoginModalBtn) openLoginModalBtn.addEventListener('click', () => showModal(loginModal));

            closeButtons.forEach(btn => btn && btn.addEventListener('click', closeAllModals));
            switchToSignupBtns.forEach(btn => btn && btn.addEventListener('click', () => showModal(signupModal)));
            switchToLoginBtns.forEach(btn => btn && btn.addEventListener('click', () => showModal(loginModal)));

            if (switchToLoginEmailBtn) switchToLoginEmailBtn.addEventListener('click', () => showModal(loginEmailModal));
            if (switchToLoginPhoneBtn) switchToLoginPhoneBtn.addEventListener('click', () => showModal(loginPhoneModal));
            if (backToLoginPhoneBtn) backToLoginPhoneBtn.addEventListener('click', () => showModal(loginPhoneModal));

            // Background click to close
            allModals.forEach(modal => {
                if (modal) modal.addEventListener('click', (e) => {
                    if (e.target === modal) closeAllModals();
                });
            });

            // --- OTP Input Logic ---
            const otpInputsContainer = document.getElementById('otp-inputs');
            if (otpInputsContainer) {
                const inputs = otpInputsContainer.querySelectorAll('.otp-input');
                const hiddenInput = document.getElementById('otp-full-input');
                inputs.forEach((input, index) => {
                    input.addEventListener('input', (e) => {
                        if (e.target.value && index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        }
                        if (hiddenInput) {
                            hiddenInput.value = Array.from(inputs).map(i => i.value).join('');
                        }
                    });
                    input.addEventListener('keydown', (e) => {
                        if (e.key === "Backspace" && !e.target.value && index > 0) {
                            inputs[index - 1].focus();
                        }
                    });
                });
            }

            // --- DYNAMIC CITY/DISTRICT DROPDOWN LOGIC ---
            const citySelect = document.getElementById('city-select');
            const districtSelect = document.getElementById('district-select');

            if (citySelect && districtSelect) {
                citySelect.addEventListener('change', function() {
                    const cityId = this.value;

                    districtSelect.innerHTML = '<option value="">جار التحميل...</option>';
                    districtSelect.disabled = true;

                    if (cityId) {
                        fetch(`/get-districts/${cityId}`)
                            .then(response => {
                                if (!response.ok) throw new Error('Network response was not ok.');
                                return response.json();
                            })
                            .then(districts => {
                                districtSelect.innerHTML = '<option value="">اختر الحي</option>';
                                if (districts.length > 0) {
                                    districts.forEach(district => {
                                        const option = document.createElement('option');
                                        option.value = district.id;
                                        option.textContent = district.name;
                                        districtSelect.appendChild(option);
                                    });
                                    districtSelect.disabled = false;
                                } else {
                                    districtSelect.innerHTML = '<option value="">لا توجد أحياء لهذه المدينة</option>';
                                }
                            })
                            .catch(error => {
                                console.error('Error fetching districts:', error);
                                districtSelect.innerHTML = '<option value="">حدث خطأ</option>';
                            });
                    } else {
                        districtSelect.innerHTML = '<option value="">اختر المدينة أولاً</option>';
                        districtSelect.disabled = true;
                    }
                });
            }

            // --- Logic to show appropriate modal after form submission (from session flash) ---
            @if (session('show_otp_modal'))
                showModal(otpModal);
            @endif

            @if ($errors->any())
                @if ($errors->has('name') || $errors->has('terms') || (old('password') && Route::currentRouteName() == 'register'))
                    showModal(signupModal);
                @elseif (old('email') && !$errors->has('phone') && Route::currentRouteName() == 'login')
                    showModal(loginEmailModal);
                @elseif ($errors->has('phone'))
                     showModal(loginPhoneModal);
                @elseif ($errors->has('otp'))
                     showModal(otpModal);
                @endif
            @endif
        });

        // Function to toggle password visibility
        function togglePasswordVisibility(button) {
            const input = button.nextElementSibling;
            if (input && input.type === "password") {
                input.type = "text";
            } else if (input) {
                input.type = "password";
            }
        }
    </script>

    {{-- =============================================== --}}
    {{-- THE CORRECT SCRIPT ORDER FOR LIVEWIRE --}}
    {{-- =============================================== --}}

    {{-- 1. Load Livewire's core scripts FIRST --}}
    @livewireScripts

    {{-- 2. Load any component-specific scripts AFTER Livewire --}}
    @stack('scripts')
    <script src="{{ asset('assets/js/auth-modals.js') }}"></script>
        <script src="{{ asset('assets/js/upgrade-modal.js') }}"></script>

    <script>
        // Auto-open login modal when URL contains ?openLogin=1 or ?openLogin
        (function() {
            try {
                const params = new URLSearchParams(window.location.search);
                if (params.has('openLogin')) {
                    // values like openLogin=1, openLogin=true, or just ?openLogin
                    const loginEmailModal = document.getElementById('login-email-modal');
                    if (loginEmailModal) {
                        // Use existing showModal helper if available, otherwise remove 'hidden'
                        if (typeof showModal === 'function') {
                            showModal(loginEmailModal);
                        } else {
                            loginEmailModal.classList.remove('hidden');
                        }
                    }
                }
            } catch (e) {
                // silent fail — non-critical
                console.error('openLogin auto-open script error:', e);
            }
        })();
    </script>

</body>
</html>
