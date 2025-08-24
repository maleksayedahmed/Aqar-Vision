{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
</body>
</html>